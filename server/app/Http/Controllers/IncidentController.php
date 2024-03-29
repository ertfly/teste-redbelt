<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiHandler;
use App\Libraries\FormValidation\FormValidation;
use App\Libraries\Input;
use App\Models\Incidents;
use App\Models\IncidentsCritics;
use App\Models\IncidentsStatus;
use App\Models\IncidentsTypes;
use Exception;

class IncidentController
{
    public function list()
    {
        $rows = [];
        foreach (Incidents::all() as $r) {
            $critical = IncidentsCritics::where('id', $r->critical_id)->first();
            $type = IncidentsTypes::where('id', $r->type_id)->first();
            $status = IncidentsStatus::where('id', $r->status_id)->first();

            $rows[] = [
                'id' => $r->id,
                'title' => $r->title,
                'description' => $r->description,
                'critical' => !$critical ? '' : $critical->description,
                'type' => !$type ? '' : $type->description,
                'status' => !$status ? '' : $status->description,
            ];
        }

        return [
            'rows' => $rows,
        ];
    }

    public function createData()
    {
        $criticals = [];
        foreach (IncidentsCritics::all() as $a) {
            $criticals[] = [
                'id' => $a->id,
                'description' => $a->description,
            ];
        }

        $types = [];
        foreach (IncidentsTypes::all() as $a) {
            $types[] = [
                'id' => $a->id,
                'description' => $a->description,
            ];
        }

        $status = [];
        foreach (IncidentsStatus::all() as $a) {
            $status[] = [
                'id' => $a->id,
                'description' => $a->description,
            ];
        }

        return [
            'criticals' => $criticals,
            'types' => $types,
            'status' => $status,
        ];
    }

    public function create()
    {
        try {
            $title = Input::json('title', 'Título', [FormValidation::REQUIRED]);
            $description = Input::json('description', 'Descrição', [FormValidation::REQUIRED]);

            $critical = IncidentsCritics::where('id', Input::json('criticalId', 'Criticidade', [FormValidation::REQUIRED, FormValidation::NUMERIC]))->first();
            if (!$critical) {
                throw new ApiHandler('Criticidade inválida!');
            }

            $type = IncidentsTypes::where('id', Input::json('typeId', 'Tipo', [FormValidation::REQUIRED, FormValidation::NUMERIC]))->first();
            if (!$type) {
                throw new ApiHandler('Tipo inválida!');
            }

            $status = IncidentsStatus::where('id', Input::json('statusId', 'Status', [FormValidation::REQUIRED, FormValidation::NUMERIC]))->first();
            if (!$status) {
                throw new ApiHandler('Status inválida!');
            }

            $user = new Incidents([
                'title' => $title,
                'description' => $description,
                'critical_id' => $critical->id,
                'type_id' => $type->id,
                'status_id' => $status->id,
            ]);
            $user->save();
        } catch (Exception $e) {
            throw new ApiHandler($e->getMessage());
        }

        return [];
    }

    public function update($id)
    {
        try {

            $incident = Incidents::where('id', $id)->first();
            if (!$incident) {
                throw new ApiHandler('Registro não encontrado!');
            }
            $title = Input::json('title', 'Título', [FormValidation::REQUIRED]);
            $description = Input::json('description', 'Descrição', [FormValidation::REQUIRED]);

            $critical = IncidentsCritics::where('id', Input::json('criticalId', 'Criticidade', [FormValidation::REQUIRED, FormValidation::NUMERIC]))->first();
            if (!$critical) {
                throw new ApiHandler('Criticidade inválida!');
            }

            $type = IncidentsTypes::where('id', Input::json('typeId', 'Tipo', [FormValidation::REQUIRED, FormValidation::NUMERIC]))->first();
            if (!$type) {
                throw new ApiHandler('Tipo inválida!');
            }

            $status = IncidentsStatus::where('id', Input::json('statusId', 'Status', [FormValidation::REQUIRED, FormValidation::NUMERIC]))->first();
            if (!$status) {
                throw new ApiHandler('Status inválida!');
            }

            $incident->title = $title;
            $incident->description = $description;
            $incident->critical_id = $critical->id;
            $incident->type_id = $type->id;
            $incident->status_id = $status->id;
            $incident->save();
        } catch (Exception $e) {
            throw new ApiHandler($e->getMessage());
        }

        return [];
    }

    public function delete($id)
    {
        $incident = Incidents::where('id', $id)->first();
        if (!$incident) {
            throw new ApiHandler('Registro não encontrado!');
        }

        $incident->delete();

        return [];
    }

    public function detail($id)
    {
        $incident = Incidents::where('id', $id)->first();
        if (!$incident) {
            throw new ApiHandler('Registro não encontrado!');
        }

        $criticals = [];
        foreach (IncidentsCritics::all() as $a) {
            $criticals[] = [
                'id' => $a->id,
                'description' => $a->description,
            ];
        }

        $types = [];
        foreach (IncidentsTypes::all() as $a) {
            $types[] = [
                'id' => $a->id,
                'description' => $a->description,
            ];
        }

        $status = [];
        foreach (IncidentsStatus::all() as $a) {
            $status[] = [
                'id' => $a->id,
                'description' => $a->description,
            ];
        }

        return [
            'id' => $incident->id,
            'title' => $incident->title,
            'description' => $incident->description,
            'criticalId' => $incident->critical_id,
            'typeId' => $incident->type_id,
            'statusId' => $incident->status_id,
            'criticals' => $criticals,
            'types' => $types,
            'status' => $status,
        ];
    }
}

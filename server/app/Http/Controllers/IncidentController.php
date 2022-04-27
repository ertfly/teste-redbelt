<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiHandler;
use App\Libraries\FormValidation\FormValidation;
use App\Libraries\Input;
use App\Models\Incidents;
use App\Models\IncidentsCritics;
use App\Models\IncidentsStatus;
use App\Models\IncidentsTypes;

class IncidentController
{
    public function list()
    {
        $rows = [];
        foreach (Incidents::all() as $r) {
            $critical = IncidentsCritics::where('id', $r->critical_id);
            $type = IncidentsTypes::where('id', $r->type_id);
            $status = IncidentsStatus::with('id', $r->status_id);

            $rows[] = [
                'id' => $r->id,
                'title' => $r->title,
                'description' => $r->description,
                'critical' => !$critical ? '' : $critical->description,
                'type' => !$type ? '' : $type->description,
                'statys' => !$status ? '' : $status->description,
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
                'selected' => false,
            ];
        }

        $types = [];
        foreach (IncidentsTypes::all() as $a) {
            $types[] = [
                'id' => $a->id,
                'description' => $a->description,
                'selected' => false,
            ];
        }

        $status = [];
        foreach (IncidentsStatus::all() as $a) {
            $status[] = [
                'id' => $a->id,
                'description' => $a->description,
                'selected' => false,
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
        $title = Input::json('title', 'Título', [FormValidation::REQUIRED]);

        $user = new Incidents([
            'title' => $title,
        ]);
        $user->save();

        return [];
    }

    public function update($id)
    {
        $incident = Incidents::where('id', $id)->first();
        if (!$incident) {
            throw new ApiHandler('Registro não encontrado!');
        }

        $title = Input::json('title', 'Título', [FormValidation::REQUIRED]);

        $incident->title = $title;
        $incident->save();

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

        return [
            'id' => $incident->id,
            'title' => $incident->title,
        ];
    }
}

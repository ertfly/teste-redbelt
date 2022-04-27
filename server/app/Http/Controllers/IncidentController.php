<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiHandler;
use App\Libraries\FormValidation\FormValidation;
use App\Libraries\Input;
use App\Models\Incidents;

class IncidentController
{
    public function list()
    {
        $rows = [];
        foreach (Incidents::all() as $r) {
            $rows[] = [
                'id' => $r->id,
                'title' => $r->title,
                'description' => $r->description,
            ];
        }

        return [
            'rows' => $rows,
        ];
    }

    public function createData()
    {
        return [];
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

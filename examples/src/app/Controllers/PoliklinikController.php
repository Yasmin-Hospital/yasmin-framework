<?php
namespace App\Controllers;

use Yasmin\Exception;
use Yasmin\Request;

use App\Models\PoliklinikModel;

class PoliklinikController { 
    
    function __construct(
        private PoliklinikModel $PoliklinikModel
    ) {}

    function rowException($idPoliklinik) {
        $data = $this->PoliklinikModel->row([['idPoliklinik', $idPoliklinik]]);
        if(!$data) {
            throw new Exception('Poliklinik not found', 'poliklinik/not-found', 404);
        }
        return $data;
    }

    function result(Request $request) {
        $order = [];
        $sort = $request->get('sort');
        if($sort !== null) {
            $order = \buildOrder($sort);
        }

        $orWhere = [];
        $search = $request->get('search');
        if($search !== null) {
            $orWhere = \buildSearch(['nmPoliklinik'], $search);
        }

        $limit = $request->get('limit') ?? -1;
        $offset = $request->get('offset') ?? 0;
        if($limit > -1 && empty($order)) {
            throw new Exception('Order must be set first', 'jabatan/sort-empty', 403);
        }
        $selectedId = [1, 2, 3];
        $where = [
            ['idPoliklinik', 'IN', $selectedId]
        ];

        return jsonResponse([
            'data' => $this->PoliklinikModel->result($where, $orWhere, $order, $limit, $offset),
            'count' => $this->PoliklinikModel->count($where, $orWhere)
        ]);
    }

    function row(string $idPoliklinik) {
        $data = $this->rowException($idPoliklinik);
        return jsonResponse($data);
    }

    function insert(Request $request) {
        $data = json_decode($request->raw(), true);
        $idPoliklinik = $this->PoliklinikModel->insert($data);
        if($idPoliklinik === false) {
            throw new Exception('Failed to insert', 'poliklinik/insert-failed');
        }
        return jsonResponse(['idPoliklinik' => $idPoliklinik], 201);
    }

    function update(Request $request, string $idPoliklinik) {
        $this->rowException($idPoliklinik);
        $data = json_decode($request->raw(), true);
        if(!$this->PoliklinikModel->update([['idPoliklinik', $idPoliklinik]], $data)) {
            throw new Exception('Failed to update', 'poliklinik/update-failed');
        }
        return response('', 204);
    }

    function delete(string $idPoliklinik) {
        $this->rowException($idPoliklinik);
        if(!$this->PoliklinikModel->delete([['idPoliklinik', $idPoliklinik]])) {
            throw new Exception('Failed to delete', 'poliklinik/delete-failed');
        }
        return response('', 204);
    }

}
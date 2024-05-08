<?php 

namespace App\Controllers;

use Yasmin\Controller;
use Yasmin\Request;
use Yasmin\Response;

use App\Models\Kontak;
use Yasmin\Exception;

class KontakController extends Controller {

    function __construct(
        private Kontak $Kontak
    ) { }

    function rowException(string $idKontak) {
        $data = $this->Kontak->row([['kontak.idKontak', $idKontak]]);
        if($data == null) {
            throw new Exception('Kontak not found', 'kontak/not-found', 404);
        }
        return $data;
    }

    function result(Request $request) {
        $order = [];
        $sort = $request->get('sort') ?? null;
        if($sort !== null) {
            $order = buildOrder($sort);
        }
        
        $orWhere = [];
        $search = $request->get('search');
        if($search !== null) {
            $orWhere = buildSearch(['nmKontak'], $search);
        }

        $limit = $request->get('limit') ?? -1;
        $offset = $request->get('offset') ?? 0;
        if($limit > -1 && empty($order)) {
            throw new Response('Order must be set first', 'kontak/sort-empty', 403);
        }

        $where = [];
        $data = $this->Kontak->result($where, $orWhere, $order, $limit, $offset);
        return jsonResponse([
            'data' => $data,
            'count' => $this->Kontak->count($where, $orWhere)
        ]);
    }

    function row(string $idKontak) {
        $this->rowException($idKontak);
        $kontak = $this->Kontak->row([['kontak.idKontak', $idKontak]]);
        return jsonResponse($kontak);
    }

    function insert(Request $request) {
        $data = json_decode($request->raw(), true);
        $idKontak = $this->Kontak->insert($data);
        return jsonResponse(['idKontak' => $idKontak], 200);
    }

    function update(Request $request, string $idKontak) {
        $kontak = $this->rowException($idKontak);
        $data = json_decode($request->raw(), true);
        if(!$this->Kontak->update([['kontak.idKontak', $kontak->idKontak]], $data)) {
            throw new Exception('Failed to update', 'kontak/update-failed', 500);
        }
        return jsonResponse(null, 204);
    }

    function delete(string $idKontak) {
        $kontak = $this->rowException($idKontak);
        if(!$this->Kontak->delete([['kontak.idKontak', $kontak->idKontak]])) {
            throw new Exception('Failed to delete', 'kontak/delete-failed', 500);
        }
        return jsonResponse(null, 204);
    }

}
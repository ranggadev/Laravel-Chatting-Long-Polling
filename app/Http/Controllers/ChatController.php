<?php

namespace App\Http\Controllers;

use App\Models\DiskusiIndividu;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ChatController extends Controller
{
    public function siswaList(Request $request) {
        // return $request->all();

        $siswaSenderId      = $request->siswa_sender_id;

        $result = Siswa::get();

        foreach ($result as $item) {
            $resultItem = DiskusiIndividu::where(function($query) use($siswaSenderId, $item) {
                                        $query->where('siswa_sender_id', $siswaSenderId)
                                        ->where('siswa_receiver_id', $item->id)
                                        ->orWhere('siswa_sender_id', $item->id)
                                        ->where('siswa_receiver_id', $siswaSenderId);
                                    })
                                    ->latest('created_at')
                                    ->first();

            if ($resultItem != null) {
                $item["last_message"] = strlen($resultItem->komentar) > 31 ? substr($resultItem->komentar, 0, 30) . "..." : $resultItem->komentar;
                $item["last_time"] = $resultItem->created_at;
            } else {
                $item["last_message"] = "";
                $item["last_time"] = "";
            }
        }

        $sortedArr = collect($result)->sortByDesc('last_time')->all();

        return response()->json([
            'status' => true,
            'message' => 'Berhasil menampilkan data',
            'data' => array_values($sortedArr),
            // 'data' => $result,
        ], 200);
    }

    public function sendMessage(request $request) {
        // return $request->all();

        $data = [
            'siswa_id'              => $request->siswa_id,
            'siswa_sender_id'       => $request->siswa_sender_id,
            'siswa_receiver_id'     => $request->siswa_receiver_id,
            'komentar'              => $request->komentar,
        ];

        $result = DiskusiIndividu::create($data);

        return response()->json([
            'status'    => true,
            'message'   => 'Pesan berhasil dikirim',
            'data'      => $result,
        ], 200);
    }

    public function chattingShow(request $request) {
        $siswaSenderId      = $request->siswa_sender_id;
        $siswaReceiverId    = $request->siswa_receiver_id;
        $latestChattingId   = $request->latest_chatting_id;

        $result = DiskusiIndividu::where(function($query) use($siswaSenderId, $siswaReceiverId) {
                                        $query->where('siswa_sender_id', $siswaSenderId)
                                        ->where('siswa_receiver_id', $siswaReceiverId)
                                        ->orWhere('siswa_sender_id', $siswaReceiverId)
                                        ->where('siswa_receiver_id', $siswaSenderId);
                                    })
                                    ->with('siswa');
                                    if ($latestChattingId != null) {
                                        $result = $result->where('id', '>', $latestChattingId);
                                    }
                                    $result = $result->orderBy('created_at', 'desc')
                                    ->get();
        
        return response()->json([
            'status' => true,
            'message' => 'Berhasil menampilkan data',
            'data' => $result,
        ], 200);
    }

    public function latestChatting(request $request) {
        $siswaSenderId      = $request->siswa_sender_id;
        $siswaReceiverId    = $request->siswa_receiver_id;

        $result = DiskusiIndividu::where(function($query) use($siswaSenderId, $siswaReceiverId) {
                                        $query->where('siswa_sender_id', $siswaSenderId)
                                        ->where('siswa_receiver_id', $siswaReceiverId)
                                        ->orWhere('siswa_sender_id', $siswaReceiverId)
                                        ->where('siswa_receiver_id', $siswaSenderId);
                                    })
                                    ->latest('created_at')
                                    ->first();
        
        return response()->json([
            'status' => true,
            'message' => 'Berhasil menampilkan data',
            'data' => $result,
        ], 200);
    }
}

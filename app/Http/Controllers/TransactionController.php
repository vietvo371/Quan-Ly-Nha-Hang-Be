<?php

namespace App\Http\Controllers;

use App\Models\HoaDonBanHang;
use App\Models\Transaction;
use Exception;
use GuzzleHttp\Client;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function getData()
    {
        // dd(1);
        $client = new Client();
        $payload = [
            "USERNAME"      => "THANHTRUONG2311",
            "PASSWORD"      => "Truong2603@@ML",
            "DAY_BEGIN"     => Carbon::today()->format('d/m/Y'),
            "DAY_END"       => Carbon::today()->format('d/m/Y'),
            "NUMBER_MB"     => "1910061030119"
        ];

        try {
            $response = $client->post('http://103.137.185.71:2603/mb', [
                'json' => $payload
            ]);

            $data = json_decode($response->getBody(), true);
            if($data['status'] == true) {
                foreach($data['data'] as $key => $value) {
                    // Vì mỗi lần chạy là nó insert lại trùng nhau, cho nên trước khi create thì ta sẽ
                    // kiểm tra refNo có chưa. Nếu chưa có thì mình mới create
                    $check = Transaction::where('refNo', $value['refNo'])->first();
                    if(!$check) {
                        // if (preg_match('/BILL\d+/', $value['description'], $matches)) {
                        //     $result = $matches[0]; // Lấy giá trị từ mảng $matches
                        //     dd($result);
                        // }
                        // Giả sử ta tìm ID = 1
                        // Tìm hóa đơn bán hàng có id = 1
                        $result = 1;
                        HoaDonBanHang::where('id', $result)->update(['is_bank', 1]);
                        Transaction::create([
                            'creditAmount'      =>  $value['creditAmount'],
                            'description'       =>  $value['description'],
                            'refNo'             =>  $value['refNo'],
                        ]);
                    }
                }
            }
            dd('done');
        } catch (Exception $e) {
            echo $e;
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Transaksi;
use App\Pembatalan;
use App\PembayaranCicilan;
use App\Pegawai;
use App\Customer;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
	private $bulans = [
		'January',
		'February',
		'March',
		'April',
		'May',
		'June',
		'July',
		'August',
		'September',
		'October',
		'November',
		'December'
	];

    public function penjualan(Request $request)
    {
    	$tahun = $request->tahun;
    	$bulan = $request->bulan;
        $pegawai = $request->pegawai;
        $customer = $request->customer;
    	$transaksis = Transaksi::whereNotNull('tgl_pelunasan')->get();

    	// pegawai jabatan marketing
    	$pegawai_login = auth()->user()->pegawai ?? null;
        // dd($pegawai_login->nip);
    	if($pegawai_login != null && $pegawai_login->jabatan == 'marketing'){
    		$transaksis = $transaksis->where('pegawai', $pegawai_login->nip);
    	}
        if($pegawai != null){
            $transaksis = $transaksis->where('pegawai', $pegawai);
        }
        if($customer != null){
            $transaksis = $transaksis->where('customer', $customer);
        }

        // filter tahun, bulan
    	if($tahun != null && $bulan == null){
    		$transaksis = $transaksis->filter(function($item,$key) use($tahun) {
    			return $item->tahunLunas() == $tahun;
    		})->groupBy(function($item,$key) {
    			return $item->bulanLunas();
    		});
    	}
    	elseif($tahun != null && $bulan != null){
    		$transaksis = $transaksis->filter(function($item,$key) use($bulan) {
    			return $item->bulanLunas() == $bulan;
    		});
    	}
    	else{
    		$transaksis = $transaksis->groupBy(function($item,$key) {
	    		return $item->tahunLunas();
	    	});
    	}

        $bulans = $this->bulans;
        $pegawais = Pegawai::all();
        $customers = Customer::all();

        $labels = $transaksis->keys();
        $data = $transaksis->map(function($item,$key) {
            return $item->count();
        });
    	
    	return view('laporan.penjualan', compact('transaksis','bulans','bulan','tahun','pegawais','pegawai','pegawai_login','customers','customer','labels','data'));
    }

    public function pembayaran()
    {
    	
    }

    public function penundaan()
    {
    	
    }

    public function pembatalan(Request $request)
    {
    	$tahun = $request->tahun;
    	$bulan = $request->bulan;
        $pegawai = $request->pegawai;
        $customer = $request->customer;
    	$pembatalans = Pembatalan::all();

    	// pegawai jabatan marketing
    	$pegawai_login = auth()->user()->pegawai ?? null;
    	if(auth()->user()->pegawai != null && $pegawai_login->jabatan == 'marketing'){
    		$pembatalans = $pembatalans->filter(function($item,$key) use($pegawai_login) {
    			return $item->transaksis->pegawais->nip == $pegawai_login->nip;
    		});
    	}
        if($pegawai != null){
            $pembatalans = $pembatalans->filter(function($item,$key) use($pegawai) {
                if($item->transaksis->pegawai != null){
                    return $item->transaksis->pegawais->nip == $pegawai;
                }
                return false;
            });
        }
        if($customer != null){
            $pembatalans = $pembatalans->filter(function($item,$key) use($customer) {
                if($item->transaksis->customer != null){
                    return $item->transaksis->customers->idcustomers == $customer;
                }
                return false;
            });
        }

    	// filter tahun, bulan
    	if($tahun != null && $bulan == null){
    		$pembatalans = $pembatalans->filter(function($item,$key) use($tahun) {
    			return $item->tahunLunas() == $tahun;
    		})->groupBy(function($item,$key) {
    			return $item->bulanLunas();
    		});
    	}
    	elseif($tahun != null && $bulan != null){
    		$pembatalans = $pembatalans->filter(function($item,$key) use($bulan) {
    			return $item->bulanLunas() == $bulan;
    		});
    	}
    	else{
    		$pembatalans = $pembatalans->groupBy(function($item,$key) {
	    		return $item->tahunLunas();
	    	});
    	}
    	
    	$bulans = $this->bulans;
        $pegawais = Pegawai::all();
        $customers = Customer::all();

        $labels = $pembatalans->keys();
        $data = $pembatalans->map(function($item,$key) {
            return $item->count();
        });
    	return view('laporan.pembatalan', compact('pembatalans','bulans','tahun','bulan','pegawais','pegawai','pegawai_login','customers','customer','labels','data'));
    }

    public function cicilan(Request $request)
    {
    	$tahun = $request->tahun;
        $bulan = $request->bulan;
        $pegawai = $request->pegawai;
        $customer = $request->customer;
        $cicilans = PembayaranCicilan::whereNotNull('tanggal_bayar')->get();

        // pegawai jabatan marketing
        $pegawai_login = auth()->user()->pegawai ?? null;
        if(auth()->user()->pegawai != null && $pegawai_login->jabatan == 'marketing'){
            $cicilans = $cicilans->filter(function($item,$key) use($pegawai_login) {
                return $item->cicilans->transaksis->pegawais->nip == $pegawai_login->nip;
            });
        }
        if($pegawai != null){
            $cicilans = $cicilans->filter(function($item,$key) use($pegawai) {
                if($item->cicilans->transaksis->pegawai != null){
                    return $item->cicilans->transaksis->pegawais->nip == $pegawai;
                }
                return false;
            });
        }
        if($customer != null){
            $cicilans = $cicilans->filter(function($item,$key) use($customer) {
                if($item->cicilans->transaksis->customer != null){
                    return $item->cicilans->transaksis->customers->idcustomers == $customer;
                }
                return false;
            });
        }

        // filter tahun, bulan
        if($tahun != null && $bulan == null){
            $cicilans = $cicilans->filter(function($item,$key) use($tahun) {
                return $item->tahunLunas() == $tahun;
            })->groupBy(function($item,$key) {
                return $item->bulanLunas();
            });
        }
        elseif($tahun != null && $bulan != null){
            $cicilans = $cicilans->filter(function($item,$key) use($bulan) {
                return $item->bulanLunas() == $bulan;
            });
        }
        else{
            $cicilans = $cicilans->groupBy(function($item,$key) {
                return $item->tahunLunas();
            });
        }
        
        $bulans = $this->bulans;
        $pegawais = Pegawai::all();
        $customers = Customer::all();

        $labels = $cicilans->keys();
        $data = $cicilans->map(function($item,$key) {
            return $item->count();
        });
        return view('laporan.cicilan', compact('cicilans','bulans','tahun','bulan','pegawais','pegawai','pegawai_login','customers','customer','labels','data'));
    }

    public function jatuhtempo(Request $request)
    {
        $tahun = $request->tahun;
        $bulan = $request->bulan;
        $pegawai = $request->pegawai;
        $customer = $request->customer;
        $cicilans = PembayaranCicilan::whereNull('tanggal_bayar')->whereDate('tenggat_waktu', '<', date('Y-m-d'))->get();
        // dd(date('Y-m-d'));

        // pegawai jabatan marketing
        $pegawai_login = auth()->user()->pegawai ?? null;
        if(auth()->user()->pegawai != null && $pegawai_login->jabatan == 'marketing'){
            $cicilans = $cicilans->filter(function($item,$key) use($pegawai_login) {
                return $item->cicilans->transaksis->pegawais->nip == $pegawai_login->nip;
            });
        }
        if($pegawai != null){
            $cicilans = $cicilans->filter(function($item,$key) use($pegawai) {
                if($item->cicilans->transaksis->pegawai != null){
                    return $item->cicilans->transaksis->pegawais->nip == $pegawai;
                }
                return false;
            });
        }
        if($customer != null){
            $cicilans = $cicilans->filter(function($item,$key) use($customer) {
                if($item->cicilans->transaksis->customer != null){
                    return $item->cicilans->transaksis->customers->idcustomers == $customer;
                }
                return false;
            });
        }

        // filter tahun, bulan
        if($tahun != null && $bulan == null){
            $cicilans = $cicilans->filter(function($item,$key) use($tahun) {
                return $item->tahunLunas() == $tahun;
            })->groupBy(function($item,$key) {
                return $item->bulanLunas();
            });
        }
        elseif($tahun != null && $bulan != null){
            $cicilans = $cicilans->filter(function($item,$key) use($bulan) {
                return $item->bulanLunas() == $bulan;
            });
        }
        else{
            $cicilans = $cicilans->groupBy(function($item,$key) {
                return $item->tahunLunas();
            });
        }
        
        $bulans = $this->bulans;
        $pegawais = Pegawai::all();
        $customers = Customer::all();

        $labels = $cicilans->keys();
        $data = $cicilans->map(function($item,$key) {
            return $item->count();
        });

        return view('laporan.jatuhtempo', compact('cicilans','bulans','tahun','bulan','pegawais','pegawai','pegawai_login','customers','customer','labels','data'));
    }
}

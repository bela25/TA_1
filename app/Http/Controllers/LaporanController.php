<?php

namespace App\Http\Controllers;

use App\Transaksi;
use App\Pembatalan;
use App\PembayaranCicilan;
use App\Pegawai;
use App\Customer;
use App\Lokasi;
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
        $lokasi = $request->lokasi;
    	$transaksis = Transaksi::all();

        // dd(Pegawai::find($pegawai));

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
        if($lokasi != null){
            $transaksis = $transaksis->filter(function($item,$key) use($lokasi) {
                return $item->units->towers->lokasis->idlokasi == $lokasi;
            });
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
        $lokasis = Lokasi::all();

        $labels = $transaksis->keys();
        $data = $transaksis->map(function($item,$key) {
            return $item->count();
        });
    	
    	return view('laporan.penjualan', compact('transaksis','bulans','bulan','tahun','pegawais','pegawai','pegawai_login','customers','customer','labels','data','lokasis','lokasi'));
    }

    public function pembatalan(Request $request)
    {
    	$tahun = $request->tahun;
    	$bulan = $request->bulan;
        $pegawai = $request->pegawai;
        $customer = $request->customer;
    	$pembatalans = Pembatalan::all();
        $lokasi = $request->lokasi;

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
        if($lokasi != null){
            $pembatalans = $pembatalans->filter(function($item,$key) use($lokasi) {
                return $item->transaksis->units->towers->lokasis->idlokasi == $lokasi;
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
        $lokasis = Lokasi::all();

        $labels = $pembatalans->keys();
        $data = $pembatalans->map(function($item,$key) {
            return $item->count();
        });
    	return view('laporan.pembatalan', compact('pembatalans','bulans','tahun','bulan','pegawais','pegawai','pegawai_login','customers','customer','labels','data','lokasis','lokasi'));
    }

    public function cicilan(Request $request)
    {
    	$tahun = $request->tahun;
        $bulan = $request->bulan;
        $pegawai = $request->pegawai;
        $customer = $request->customer;
        $lokasi = $request->lokasi;
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
        if($lokasi != null){
            $cicilans = $cicilans->filter(function($item,$key) use($lokasi) {
                return $item->cicilans->transaksis->units->towers->lokasis->idlokasi == $lokasi;
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
        $lokasis = Lokasi::all();

        $labels = $cicilans->keys();
        $data = $cicilans->map(function($item,$key) {
            return $item->count();
        });
        return view('laporan.cicilan', compact('cicilans','bulans','tahun','bulan','pegawais','pegawai','pegawai_login','customers','customer','labels','data','lokasis','lokasi'));
    }

    public function jatuhtempo(Request $request)
    {
        $tahun = $request->tahun;
        $bulan = $request->bulan;
        $pegawai = $request->pegawai;
        $customer = $request->customer;
        $lokasi = $request->lokasi;
        $cicilans = PembayaranCicilan::whereNull('tanggal_bayar')->whereDate('tenggat_waktu', '<', date('Y-m-d'))->get();

        $cicilans = $cicilans->filter(function($item,$key) {
            return $item->cicilans->transaksis->status == 'aktif';
        });

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
        if($lokasi != null){
            $cicilans = $cicilans->filter(function($item,$key) use($lokasi) {
                return $item->cicilans->transaksis->units->towers->lokasis->idlokasi == $lokasi;
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
        $lokasis = Lokasi::all();

        $labels = $cicilans->keys();
        $data = $cicilans->map(function($item,$key) {
            return $item->count();
        });

        return view('laporan.jatuhtempo', compact('cicilans','bulans','tahun','bulan','pegawais','pegawai','pegawai_login','customers','customer','labels','data','lokasis','lokasi'));
    }
}

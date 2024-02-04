<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\BeritaAcaraSkripsi as BeritaAcaraSkripsi;
use App\Models\DetailBeritaAcaraSkripsi as DetailBeritaAcaraSkripsi;

class BeritaAcaraSkripsiController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkDosen');
    }
    public function index()
    {
        try {
            $baskripsi = DB::table('berita_acara_skripsi')
            ->join('users', 'users.id', 'berita_acara_skripsi.users_id')
            ->join('sidang_skripsi', 'sidang_skripsi.id_sidang_skripsi', 'berita_acara_skripsi.sidang_skripsi_id')
            ->leftjoin('bimbingan_skripsi', 'bimbingan_skripsi.id_bimbingan_skripsi', 'sidang_skripsi.bimbingan_skripsi_id')
            ->leftjoin('bimbingan_proposal', 'bimbingan_proposal.id_bimbingan_proposal', 'bimbingan_skripsi.bimbingan_proposal_id')
            ->join('ruangan', 'ruangan.id_ruangan', 'sidang_skripsi.ruangan')
            ->where(function($query) {
                $query->where('sidang_skripsi.dosen_penguji_1', Auth::user()->id)
                    ->orWhere('sidang_skripsi.dosen_penguji_2',  Auth::user()->id)
                    ->orWhere('sidang_skripsi.dosen_penguji_3', Auth::user()->id)
                    ->orWhere('bimbingan_proposal.dosen_pembimbing_utama', Auth::user()->name);
            })
            ->latest('berita_acara_skripsi.created_at')
            ->get();

            $angkatan = DB::table('angkatan')->get();


            return view('dosen/berita_acara/sidang.index', compact('baskripsi', 'angkatan'));
        } catch (\Exception $e) {
            // Menangani eksepsi di sini
            return view('404'); // Atau Anda dapat mengembalikan tampilan khusus untuk error
        }
    }
    public function detail($id)
    {
        try {
            $data = [
                'data' => DB::table('berita_acara_skripsi')
                    ->join('users', 'users.id', 'berita_acara_skripsi.users_id')
                    ->join('sidang_skripsi', 'sidang_skripsi.id_sidang_skripsi', 'berita_acara_skripsi.sidang_skripsi_id')
                    ->join('users as penguji1', 'penguji1.id', 'sidang_skripsi.dosen_penguji_1')
                    ->join('users as penguji2', 'penguji2.id', 'sidang_skripsi.dosen_penguji_2')
                    ->join('users as penguji3', 'penguji3.id', 'sidang_skripsi.dosen_penguji_3')
                    ->join('users as sekretaris', 'sekretaris.id', 'sidang_skripsi.sekretaris')
                    ->join('bimbingan_skripsi', 'bimbingan_skripsi.id_bimbingan_skripsi', 'sidang_skripsi.bimbingan_skripsi_id')
                    ->join('bimbingan_proposal', 'bimbingan_proposal.id_bimbingan_proposal', 'bimbingan_skripsi.bimbingan_proposal_id')
                    ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'bimbingan_proposal.bidang_ilmu_id')
                    ->join('pengajuan_judul', 'pengajuan_judul.id_pengajuan_judul', 'bimbingan_proposal.pengajuan_id')
                    ->join('ruangan', 'ruangan.id_ruangan', 'sidang_skripsi.ruangan')
                    ->where('id_berita_acara_s', '=', $id)
                    ->select('berita_acara_skripsi.*', 'users.*', 'sidang_skripsi.*', 'bidang_ilmu.*', 'bimbingan_skripsi.*', 'bimbingan_proposal.*', 'penguji1.name as nama_penguji_1', 'penguji2.name as nama_penguji_2', 'penguji3.name as nama_penguji_3', 'sekretaris.name as nama_sekretaris', 'pengajuan_judul.judul', 'ruangan.nama_ruangan')
                    ->first(),
            ];

            if (!$data['data']) {
                throw new \Exception('Data not found'); // Melempar eksepsi jika data tidak ditemukan
            }

            $detail = [
                'detail' => DB::table('detail_berita_acara_skripsi')->where('berita_acara_skripsi_id', $id)->where('users_id', Auth::user()->id)->first(),
            ];

            return view('dosen/berita_acara/sidang.detail', $data, $detail);
        } catch (\Exception $e) {
            // Menangani eksepsi di sini
            return view('404'); // Atau Anda dapat mengembalikan tampilan khusus untuk error
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'berita_acara_skripsi_id' => 'required|integer',
                'revisi' => 'required|string',
                'nilai_1' => 'required|numeric',
                'nilai_2' => 'required|numeric',
                'nilai_3' => 'required|numeric',
                'nilai_4' => 'required|numeric',
                'nilai_5' => 'required|numeric',
            ]);

            $detailBAS = new DetailBeritaAcaraSkripsi();
            $detailBAS->users_id = Auth::user()->id;
            $detailBAS->berita_acara_skripsi_id = $request->berita_acara_skripsi_id;
            $detailBAS->presensi = 'hadir';
            $detailBAS->revisi = $request->revisi;

            $persentase_penulisan = 10;
            $persentase_penyajian = 20;
            $persentase_penguasaan_program = 30;
            $persentase_penguasaan_materi = 30;
            $persentase_penampilan = 10;

            $nilai_penulisan = $request->input('nilai_1');
            $nilai_penyajian = $request->input('nilai_2');
            $nilai_penguasaan_program = $request->input('nilai_3');
            $nilai_penguasaan_materi = $request->input('nilai_4');
            $nilai_penampilan = $request->input('nilai_5');

            $nilai_total = (
                ($nilai_penulisan * $persentase_penulisan / 100) +
                ($nilai_penyajian * $persentase_penyajian / 100) +
                ($nilai_penguasaan_program * $persentase_penguasaan_program / 100) +
                ($nilai_penguasaan_materi * $persentase_penguasaan_materi / 100) +
                ($nilai_penampilan * $persentase_penampilan / 100)
            );

            $detailBAS->nilai_penulisan = $nilai_penulisan;
            $detailBAS->nilai_penyajian = $nilai_penyajian;
            $detailBAS->nilai_penguasaan_program = $nilai_penguasaan_program;
            $detailBAS->nilai_penguasaan_materi = $nilai_penguasaan_materi;
            $detailBAS->nilai_penampilan = $nilai_penampilan;
            $detailBAS->nilai_total = $nilai_total;

            $detailBAS->save();

            return redirect()->route('berita-acara-skripsi.index')->with('success', 'Berita Acara Skripsi berhasil diisi.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan validasi: ' . $e->getMessage())->withInput();
        }
    }

}

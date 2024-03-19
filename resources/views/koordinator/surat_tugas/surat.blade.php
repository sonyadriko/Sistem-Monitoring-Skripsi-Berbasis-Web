<html>

<head>
    <title>Surat Bimbingan</title>
    <style type="text/css">
        body {
            font-family: Arial;
            font-size: 20.6px
        }

        .pos {
            position: absolute;
            z-index: 0;
            left: 0px;
            top: 0px
        }
    </style>
</head>

<body>
    <nobr>
        <nowrap>
            <div class="pos" id="_0:0" style="top:0">
                <img name="_1170:827" src={{ asset('img/surat_tugas/page_001.png') }} height="1170" width="827"
                    border="0" usemap="#Map">
            </div>
            <div class="pos" id="_39:180" style="top:180;left:39">
                <span id="_16.3" style=" font-family:Times New Roman; font-size:16.3px; color:#000000">
                </span>
            </div>
            <div class="pos" id="_339:173" style="top:170;left:339">
                <span id="_26.4" style=" font-family:Arial; font-size:26.4px; color:#000000">
                    SURAT TUGAS</span>
            </div>
            <div class="pos" id="_288:203" style="top:203;left:325">
                <span id="_14.5" style=" font-family:Times New Roman; font-size:14.5px; color:#000000">
                    Nomor : {{ $data->nomor_surat_tugas }}</span>
            </div>
            <div class="pos" id="_39:236" style="top:236;left:39">
                <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
                    Dasar </span>
            </div>
            <div class="pos" id="_139:236" style="top:236;left:139">
                <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
                    : </span>
            </div>
            <div class="pos" id="_59:254" style="top:254;left:59">
                <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
                    1. SKEP Rektor ITATS Nomor : SKEP/22/ITATS/III/2009 tentang Bimbingan, Sidang Proposal, Sidang
                    Progress
                </span>
            </div>
            <div class="pos" id="_78:272" style="top:272;left:75">
                <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
                    & Sidang Akhir / Tugas Akhir Program Strata 1 Tahun 2009 Institut Teknologi Adhi Tama
                    Surabaya.</span>
            </div>
            <div class="pos" id="_59:289" style="top:289;left:59">
                <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
                    2. SKEP Rektor ITATS Nomor : SKEP/25/ITATS/VII/2019 tentang Pedoman Akademik Program Strata I Tahun
                </span>
            </div>
            <div class="pos" id="_78:307" style="top:307;left:75">
                <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
                    2019/2020 Institut Teknologi Adhi Tama Surabaya.</span>
            </div>
            <div class="pos" id="_59:324" style="top:324;left:59">
                <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
                    3. Kalender Akademik Institut Teknologi Adhi Tama Surabaya Tahun 2019/2020</span>
            </div>
            <div class="pos" id="_161:352" style="top:352;left:161">
                <span id="_19.1"
                    style="font-weight:bold; font-family:Times New Roman; font-size:19.1px; color:#000000">
                    Dekan Fakultas Teknik Elektro dan Teknologi Informasi</span>
            </div>
            <div class="pos" id="_39:381" style="top:381;left:39">
                <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
                    Dengan ini menugaskan kepada :</span>
            </div>
            <div class="pos" id="_39:416" style="top:416;left:39">
                <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
                    Nama Pembimbing I</span>
            </div>
            <div class="pos" id="_189:416" style="top:416;left:189">
                <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
                    : {{ $data->dosen_pembimbing_utama }}</span>
            </div>
            <div class="pos" id="_39:442" style="top:442;left:39">
                <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
                    Nama Pembimbing II</span>
            </div>
            <div class="pos" id="_189:416" style="top:442;left:189">
                <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
                    : @if ($data->dosen_pembimbing_ii == 'tidak ada')
                        -
                    @endif
                </span>
            </div>
            <div class="pos" id="_39:468" style="top:468;left:39">
                <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
                    Tugas</span>
            </div>
            <div class="pos" id="_189:468" style="top:468;left:189">
                <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
                    : Membimbing Skripsi Mahasiswa,</span>
            </div>
            <div class="pos" id="_196:494" style="top:494;left:196">
                <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
                    Nama</span>
            </div>
            <div class="pos" id="_289:494" style="top:494;left:289">
                <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
                    : {{ $data->name }}</span>
            </div>
            <div class="pos" id="_196:511" style="top:511;left:196">
                <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
                    N.P.M.</span>
            </div>
            <div class="pos" id="_289:511" style="top:511;left:289">
                <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
                    : {{ $data->kode_unik }} </span>
            </div>
            <div class="pos" id="_196:529" style="top:529;left:196">
                <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
                    Alamat</span>
            </div>
            <div class="pos" id="_285:529" style="top:529;left:289">
                <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
                    : {{ $data->alamat_mhs }} </span>
            </div>
            <div class="pos" id="_139:546" style="top:546;left:139">
                <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
                </span>
            </div>
            <div class="pos" id="_196:546" style="top:546;left:196">
                <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
                    Telp.</span>
            </div>
            <div class="pos" id="_289:546" style="top:546;left:289">
                <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
                    : {{ $data->no_telp_mhs }}</span>
            </div>
            <div class="pos" id="_48:572" style="top:572;left:48">
                <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
                    Judul Skripsi </span>
            </div>
            <div class="pos" id="_187:572" style="top:572;left:187">
                <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
                    : {{ $data->judul }} </span>
            </div>
            <div class="pos" id="_39:616" style="top:616;left:39">
                <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
                    Tugas</span>
            </div>
            <div class="pos" id="_187:616" style="top:616;left:187">
                <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
                    : </span>
            </div>
            <div class="pos" id="_64:633" style="top:633;left:64">
                <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
                    1. Memecahkan masalah Seminar Proposal <span id="_13.6"
                        style="font-weight:bold; font-size:13.6px">
                    </span><span id="_13.6" style="font-weight:bold; font-size:13.6px"> - </span> Skripsi dengan
                    musyawarah
                    mufakat yang mengedepankan </span>
            </div>
            <div class="pos" id="_89:651" style="top:651;left:80">
                <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
                    obyektifitas keilmuan serta kemanfaatan bagi peserta seminar.</span>
            </div>
            <div class="pos" id="_64:668" style="top:668;left:64">
                <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
                    2. Membimbing, menguji, memberi masukan dan penilaian secara obyektif dan tidak berpihak.</span>
            </div>
            <div class="pos" id="_64:686" style="top:686;left:64">
                <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
                    3. Memonitor kelancaran proses pembimbingan skripsi.</span>
            </div>
            <div class="pos" id="_39:721" style="top:721;left:39">
                <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
                    Tempat</span>
            </div>
            <div class="pos" id="_189:721" style="top:721;left:189">
                <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
                    : Jurusan Sistem Informasi</span>
            </div>
            <div class="pos" id="_39:747" style="top:747;left:39">
                <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
                    Pelaksanaan</span>
            </div>
            <div class="pos" id="_189:747" style="top:747;left:189">
                <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
                    : Sesuai dengan ketentuan yang ada pada Buku Panduan Skripsi jurusan Sistem Informasi</span>
            </div>
            <div class="pos" id="_39:773" style="top:773;left:39">
                <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
                    Demikian surat tugas ini agar dilaksanakan sebaik &#150; baiknya dengan rasa tanggung jawab.</span>
            </div>
            <div class="pos" id="_389:808" style="top:808;left:389">
                <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
                    Surabaya, {{ \Carbon\Carbon::parse($data->tanggal_terbit)->translatedFormat('j F Y') }}
                </span>
            </div>
            <div class="pos" id="_389:826" style="top:826;left:389">
                <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
                    Fakultas Teknik Elektro dan Teknologi Informasi</span>
            </div>
            <div class="pos" id="_389:844" style="top:844;left:389">
                <span id="_15.0"
                    style="font-weight:bold; font-family:Times New Roman; font-size:15.0px; color:#000000">
                    Dekan,</span>
            </div>
            <div class="pos" id="_389:914" style="top:914;left:389">
                <span id="_15.0"
                    style="font-weight:bold; font-family:Times New Roman; font-size:15.0px; color:#000000">
                    <U>D</U><U>r</U><U>.</U><U> </U><U>I</U><U>r</U><U>.</U><U> </U><U>H</U><U>a</U><U>r</U><U>i</U><U>
                    </U><U>A</U><U>g</U><U>u</U><U>s</U><U>
                    </U><U>S</U><U>u</U><U>j</U><U>o</U><U>n</U><U>o</U><U>,</U><U>
                    </U><U>M</U><U>.</U><U>S</U><U>c</U><U>.</U> </span>
            </div>
            <div class="pos" id="_389:931" style="top:931;left:389">
                <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
                    NIP. 981092</span>
            </div>
            <div class="pos" id="_39:949" style="top:949;left:39">
                <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
                    Tembusan :</span>
            </div>
            <div class="pos" id="_64:966" style="top:966;left:64">
                <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
                    1. Dosen yang bersangkutan</span>
            </div>
            <div class="pos" id="_64:984" style="top:984;left:64">
                <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
                    2. Mahasiswa yang dibimbing</span>
            </div>
            <div class="pos" id="_64:1001" style="top:1001;left:64">
                <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
                    3. Koordinator Skripsi</span>
            </div>
            <div class="pos" id="_64:1019" style="top:1019;left:64">
                <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
                    4. Jurusan Sistem Informasi</span>
            </div>
            <div class="pos" id="_64:1037" style="top:1037;left:64">
                <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
                    5. Arsip</span>
            </div>
            <div class="pos" id="_0:0" style="top:1174">
                <img name="_1170:827" src={{ asset('img/surat_tugas/page_002.png') }} height="1170" width="827"
                    border="0" usemap="#Map">
            </div>
            <div class="pos" id="_670:1334" style="top:1339;left:670">
                <span id="_13.3" style="font-weight:bold; font-family:Arial; font-size:13.3px; color:#000000">
                    FORM C &#150; 26.2</span>
            </div>
            <div class="pos" id="_460:1350" style="top:1355;left:460">
                <span id="_12.0" style="font-weight:bold; font-family:Arial; font-size:12.0px; color:#000000">
                    No</span>
            </div>
            <div class="pos" id="_557:1350" style="top:1355;left:557">
                <span id="_12.0" style="font-weight:bold; font-family:Arial; font-size:12.0px; color:#000000">
                    : 1.6.3/ITATS/FORM/SPM/C-26.2</span>
            </div>
            <div class="pos" id="_460:1364" style="top:1369;left:460">
                <span id="_12.0" style="font-weight:bold; font-family:Arial; font-size:12.0px; color:#000000">
                    Tanggal Terbit</span>
            </div>
            <div class="pos" id="_460:1364" style="top:1369;left:557">
                <span id="_12.0" style="font-weight:bold; font-family:Arial; font-size:12.0px; color:#000000">
                    : 15 September 2021</span>
            </div>
            <div class="pos" id="_460:1379" style="top:1384;left:460">
                <span id="_12.0" style="font-weight:bold; font-family:Arial; font-size:12.0px; color:#000000">
                    Revisi</span>
            </div>
            <div class="pos" id="_557:1379" style="top:1384;left:557">
                <span id="_12.0" style="font-weight:bold; font-family:Arial; font-size:12.0px; color:#000000">
                    : 00</span>
            </div>
            <div class="pos" id="_235:1414" style="top:1414;left:235">
                <span id="_17.3"
                    style="font-weight:bold; font-family:Times New Roman; font-size:17.3px; color:#000000">
                    KEMAJUAN PENYELESAIAN SKRIPSI</span>
            </div>
            <div class="pos" id="_76:1470" style="top:1470;left:76">
                <span id="_16.0" style=" font-family:Times New Roman; font-size:16.0px; color:#000000">
                    Nama</span>
            </div>
            <div class="pos" id="_285:1470" style="top:1470;left:285">
                <span id="_16.0" style=" font-family:Times New Roman; font-size:16.0px; color:#000000">
                    : {{ $data->name }}</span>
            </div>
            <div class="pos" id="_76:1489" style="top:1489;left:76">
                <span id="_16.0" style=" font-family:Times New Roman; font-size:16.0px; color:#000000">
                    NPM</span>
            </div>
            <div class="pos" id="_285:1489" style="top:1489;left:285">
                <span id="_16.0" style=" font-family:Times New Roman; font-size:16.0px; color:#000000">
                    : {{ $data->kode_unik }} </span>
            </div>
            <div class="pos" id="_76:1508" style="top:1508;left:76">
                <span id="_16.5" style=" font-family:Times New Roman; font-size:16.5px; color:#000000">
                    Judul Skripsi</span>
            </div>
            <div class="pos" id="_285:1508" style="top:1508;left:285">
                <span id="_16.5" style="font-family: Times New Roman; font-size: 16.5px; color: #000000">
                    : {{ Illuminate\Support\Str::words($data->judul, 7, '') }}
                </span>
            </div>
            <div class="pos" id="_305:1527" style="top:1527;left:293">
                <span id="_16.5" style="font-family: Times New Roman; font-size: 16.5px; color: #000000">
                    {{ str_word_count($data->judul) > 7 ? implode(' ', array_slice(explode(' ', $data->judul), 7)) : '' }}
                </span>
            </div>



            <div class="pos" id="_76:1555" style="top:1555;left:76">
                <span id="_16.5" style=" font-family:Times New Roman; font-size:16.5px; color:#000000">
                    Dosen Pembimbing</span>
            </div>
            <div class="pos" id="_285:1555" style="top:1555;left:285">
                <span id="_16.5" style=" font-family:Times New Roman; font-size:16.5px; color:#000000">
                    : {{ $data->dosen_pembimbing_utama }}</span>
            </div>
            <div class="pos" id="_87:1606" style="top:1606;left:87">
                <span id="_16.5"
                    style="font-weight:bold; font-family:Times New Roman; font-size:16.5px; color:#000000">
                    No</span>
            </div>
            <div class="pos" id="_175:1606" style="top:1606;left:175">
                <span id="_16.5"
                    style="font-weight:bold; font-family:Times New Roman; font-size:16.5px; color:#000000">
                    Tanggal</span>
            </div>
            <div class="pos" id="_360:1606" style="top:1606;left:360">
                <span id="_16.5"
                    style="font-weight:bold; font-family:Times New Roman; font-size:16.5px; color:#000000">
                    Catatan Pembimbing</span>
            </div>
            <div class="pos" id="_622:1596" style="top:1596;left:622">
                <span id="_16.5"
                    style="font-weight:bold; font-family:Times New Roman; font-size:16.5px; color:#000000">
                    Tanda Tangan </span>
            </div>
            <div class="pos" id="_629:1615" style="top:1615;left:629">
                <span id="_16.5"
                    style="font-weight:bold; font-family:Times New Roman; font-size:16.5px; color:#000000">
                    Pembimbing</span>
            </div>
            <div class="pos" id="_39:2167" style="top:2167;left:39">
                <span id="_16.5"
                    style="font-weight:bold; font-family:Times New Roman; font-size:16.5px; color:#000000">
                    Catatan: </span>
            </div>
            <div class="pos" id="_39:2186" style="top:2186;left:39">
                <span id="_16.5" style=" font-family:Times New Roman; font-size:16.5px; color:#000000">
                    Persyaratan sidang minimal melaksanakan tatap muka bimbingan sebanyak 12 x dengan Dosen Pembimbing
                </span>
            </div>
            <div class="pos" id="_39:2205" style="top:2205;left:39">
                <span id="_16.5" style=" font-family:Times New Roman; font-size:16.5px; color:#000000">
                    Utama + Pembimbing Pendamping</span>
            </div>
            <div class="pos" id="_0:0" style="top:2349">
                <img name="_1170:827" src="{{ asset('img/surat_tugas/page_003.png') }}" height="1170"
                    width="827" border="0" usemap="#Map">
            </div>
            <div class="pos" id="_668:2508" style="top:2517;left:668">
                <span id="_13.3" style="font-weight:bold; font-family:Arial; font-size:13.3px; color:#000000">
                    FORM C &#150; 26.4</span>
            </div>
            <div class="pos" id="_458:2524" style="top:2533;left:458">
                <span id="_12.0" style=" font-family:Arial; font-size:12.0px; color:#000000">
                    No</span>
            </div>
            <div class="pos" id="_555:2524" style="top:2533;left:555">
                <span id="_12.0" style=" font-family:Arial; font-size:12.0px; color:#000000">
                    : 1.6.3/ITATS/FORM/SPM/C-26.4</span>
            </div>
            <div class="pos" id="_458:2539" style="top:2548;left:458">
                <span id="_12.0" style=" font-family:Arial; font-size:12.0px; color:#000000">
                    Tanggal Terbit</span>
            </div>
            <div class="pos" id="_458:2539" style="top:2548;left:555">
                <span id="_12.0" style=" font-family:Arial; font-size:12.0px; color:#000000">
                    : 15 September 2021</span>
            </div>
            <div class="pos" id="_458:2553" style="top:2562;left:458">
                <span id="_12.0" style=" font-family:Arial; font-size:12.0px; color:#000000">
                    Revisi</span>
            </div>
            <div class="pos" id="_555:2553" style="top:2562;left:555">
                <span id="_12.0" style=" font-family:Arial; font-size:12.0px; color:#000000">
                    : 00</span>
            </div>
            <div class="pos" id="_257:2590" style="top:2590;left:257">
                <span id="_17.3"
                    style="font-weight:bold; font-family:Times New Roman; font-size:17.3px; color:#000000">
                    PERSETUJUAN SIDANG SKRIPSI</span>
            </div>
            <div class="pos" id="_76:2630" style="top:2630;left:76">
                <span id="_16.0" style=" font-family:Times New Roman; font-size:16.0px; color:#000000">
                    Nama</span>
            </div>
            <div class="pos" id="_292:2630" style="top:2630;left:292">
                <span id="_16.0" style=" font-family:Times New Roman; font-size:16.0px; color:#000000">
                    : {{ $data->name }}</span>
            </div>
            <div class="pos" id="_76:2658" style="top:2658;left:76">
                <span id="_16.0" style=" font-family:Times New Roman; font-size:16.0px; color:#000000">
                    NPM</span>
            </div>
            <div class="pos" id="_292:2658" style="top:2658;left:292">
                <span id="_16.0" style=" font-family:Times New Roman; font-size:16.0px; color:#000000">
                    : {{ $data->kode_unik }}</span>
            </div>
            <div class="pos" id="_76:2687" style="top:2687;left:76">
                <span id="_16.0" style=" font-family:Times New Roman; font-size:16.0px; color:#000000">
                    Fakultas</span>
            </div>
            <div class="pos" id="_292:2687" style="top:2687;left:292">
                <span id="_16.0" style=" font-family:Times New Roman; font-size:16.0px; color:#000000">
                    : Teknik Elektro dan Teknologi Informasi</span>
            </div>
            <div class="pos" id="_76:2716" style="top:2716;left:76">
                <span id="_16.0" style=" font-family:Times New Roman; font-size:16.0px; color:#000000">
                    Jurusan </span>
            </div>
            <div class="pos" id="_292:2716" style="top:2716;left:292">
                <span id="_16.0" style=" font-family:Times New Roman; font-size:16.0px; color:#000000">
                    : Sistem Informasi</span>
            </div>
            <div class="pos" id="_76:2745" style="top:2745;left:76">
                <span id="_16.0" style=" font-family:Times New Roman; font-size:16.0px; color:#000000">
                    Alamat di Surabaya</span>
            </div>
            <div class="pos" id="_292:2745" style="top:2745;left:292">
                <span id="_16.0" style=" font-family:Times New Roman; font-size:16.0px; color:#000000">
                    : {{ $data->alamat_mhs }}</span>
            </div>
            <div class="pos" id="_76:2773" style="top:2773;left:76">
                <span id="_16.0" style=" font-family:Times New Roman; font-size:16.0px; color:#000000">
                    No Telp / HP</span>
            </div>
            <div class="pos" id="_292:2773" style="top:2773;left:292">
                <span id="_16.0" style=" font-family:Times New Roman; font-size:16.0px; color:#000000">
                    : {{ $data->no_telp_mhs }}</span>
            </div>
            <div class="pos" id="_76:2802" style="top:2802;left:76">
                <span id="_16.0" style=" font-family:Times New Roman; font-size:16.0px; color:#000000">
                    Alamat Orang Tua</span>
            </div>
            <div class="pos" id="_292:2802" style="top:2802;left:292">
                <span id="_16.0" style=" font-family:Times New Roman; font-size:16.0px; color:#000000">
                    : {{ $data->alamat_orang_tua }}</span>
            </div>
            <div class="pos" id="_76:2831" style="top:2831;left:76">
                <span id="_16.0" style=" font-family:Times New Roman; font-size:16.0px; color:#000000">
                    No Telp Orang Tua</span>
            </div>
            <div class="pos" id="_292:2831" style="top:2831;left:292">
                <span id="_16.0" style=" font-family:Times New Roman; font-size:16.0px; color:#000000">
                    : {{ $data->no_telp_orang_tua }}</span>
            </div>
            <div class="pos" id="_76:2860" style="top:2860;left:76">
                <span id="_16.5" style=" font-family:Times New Roman; font-size:16.5px; color:#000000">
                    Judul Skripsi</span>
            </div>
            <div class="pos" id="_292:2860" style="top:2860;left:292">
                <span id="_16.5" style=" font-family:Times New Roman; font-size:16.5px; color:#000000">
                    : {{ Illuminate\Support\Str::words($data->judul, 7, '') }} </span>
            </div>
            <div class="pos" id="_312:2888" style="top:2888;left:302">
                <span id="_16.5" style=" font-family:Times New Roman; font-size:16.5px; color:#000000">
                    {{ str_word_count($data->judul) > 7 ? implode(' ', array_slice(explode(' ', $data->judul), 7)) : '' }}</span>
            </div>
            <div class="pos" id="_76:2917" style="top:2917;left:76">
                <span id="_16.5" style=" font-family:Times New Roman; font-size:16.5px; color:#000000">
                    Tanggal Mengajukan Skripsi</span>
            </div>
            <div class="pos" id="_76:2917" style="top:2917;left:292">
                <span id="_16.5" style=" font-family:Times New Roman; font-size:16.5px; color:#000000">
                    : {{ \Carbon\Carbon::parse($data->tanggal_terbit)->translatedFormat('j F Y') }}</span>
            </div>
            <div class="pos" id="_76:2946" style="top:2946;left:76">
                <span id="_16.5" style=" font-family:Times New Roman; font-size:16.5px; color:#000000">
                    Batas Akhir Bimbingan</span>
            </div>
            <div class="pos" id="_292:2946" style="top:2946;left:292">
                <span id="_16.5" style=" font-family:Times New Roman; font-size:16.5px; color:#000000">
                    : {{ \Carbon\Carbon::parse($data->tanggal_kadaluwarsa)->translatedFormat('j F Y') }}</span>
            </div>
            <div class="pos" id="_126:2994" style="top:2994;left:126">
                <span id="_16.5"
                    style="font-weight:bold; font-family:Times New Roman; font-size:16.5px; color:#000000">
                    Disetujui / Belum Disetujui<span style="font-weight:normal"> oleh Dosen Pembimbing untuk dapat maju
                        Sidang
                        Skripsi</span></span>
            </div>
            <div class="pos" id="_442:3161" style="top:3161;left:442">
                <span id="_16.5" style=" font-family:Times New Roman; font-size:16.5px; color:#000000">
                    Surabaya,</span>
            </div>
            <div class="pos" id="_442:3180" style="top:3180;left:442">
                <span id="_16.5" style=" font-family:Times New Roman; font-size:16.5px; color:#000000">
                    Dosen Pembimbing I</span>
            </div>
            <div class="pos" id="_39:3205" style="top:3205;left:39">
                <span id="_16.5" style=" font-family:Times New Roman; font-size:16.5px; color:#000000">
                    Catatan:</span>
            </div>
            <div class="pos" id="_39:3224" style="top:3224;left:39">
                <span id="_16.5" style=" font-family:Times New Roman; font-size:16.5px; color:#000000">
                    Persyaratan mengikuti sidang skripsi</span>
            </div>
            <div class="pos" id="_39:3243" style="top:3243;left:39">
                <span id="_16.5" style=" font-family:Times New Roman; font-size:16.5px; color:#000000">
                    1. Lama bimbingan minimal 3 bulan</span>
            </div>
            <div class="pos" id="_39:3262" style="top:3262;left:39">
                <span id="_13.7" style=" font-family:Times New Roman; font-size:13.7px; color:#000000">
                    2.<span id="_16.5" style=" font-size:16.5px"> Tatap muka bimbingan minimal 12x</span></span>
            </div>
            <div class="pos" id="_442:3271" style="top:3271;left:442">
                <span id="_16.5"
                    style="font-weight:bold; font-family:Times New Roman; font-size:16.5px; color:#000000">
                    <U> ({{ $data->dosen_pembimbing_utama }})
                    </U></span>
            </div>
            <div class="pos" id="_442:3290" style="top:3290;left:442">
                <span id="_16.5" style=" font-family:Times New Roman; font-size:16.5px; color:#000000">
                    NIP. {{ $data->nipdosen }}</span>
            </div>
        </nowrap>
    </nobr>
</body>

</html>
<script>
    window.print();
</script>

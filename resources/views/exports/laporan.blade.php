<table>
    <tr>
        <td style="font-weight: bold;" colspan="11">LAPORAN RENTANG TANGGAL : {{ App\Models\Helper::formatDateToIndoDate($from) }} s/d {{ App\Models\Helper::formatDateToIndoDate($to) }}</td>
    </tr>
    <tr></tr>
    <tr>
        <td>Omzet (Rp) :</td>
        <td>{{ $omzet_rentang_uang }}</td>
    </tr>
    <tr>
        <td>Profit (Rp) :</td>
        <td>{{ $profit_rentang_uang }}</td>
    </tr>
    <tr>
        <td>Pesanan :</td>
        <td>{{ $pesanan_rentang }}</td>
    </tr>
    <tr></tr>
    <thead>
    <tr>
        <th style="font-weight: bold;" width="12">No Antrian</th>
        <th style="font-weight: bold;" width="20">Nama Pelanggan</th>
        <th style="font-weight: bold;" width="20">Status Pesanan</th>
        <th style="font-weight: bold;" width="20">Subtotal</th>
        <th style="font-weight: bold;" width="10">Tax (%)</th>
        <th style="font-weight: bold;" width="20">Grand Total (Rp)</th>
        <th style="font-weight: bold;" width="20">Dibayar (Rp)</th>
        <th style="font-weight: bold;" width="20">Kembalian (Rp)</th>
        <th style="font-weight: bold;" width="10">ID Kasir</th>
        <th style="font-weight: bold;" width="20">Nama Kasir</th>
        <th style="font-weight: bold;" width="25">Waktu</th>
    </tr>
    </thead>
    <tbody>
    @foreach($laporans as $laporan)
        <tr>
            <td>{{ $laporan->no_antrian }}</td>
            <td>{{ $laporan->nama_pelanggan }}</td>
            <td>{{ $laporan->status_pesanan }}</td>
            <td>{{ $laporan->subtotal }}</td>
            <td>{{ $laporan->tax }}</td>
            <td>{{ $laporan->grand_total }}</td>
            <td>{{ $laporan->dibayar }}</td>
            <td>{{ $laporan->kembalian }}</td>
            <td>{{ $laporan->user_id }}</td>
            <td>{{ $laporan->user_name }}</td>
            <td>{{ App\Models\Helper::formatDateTimeToIndoDateTime($laporan->created_at) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
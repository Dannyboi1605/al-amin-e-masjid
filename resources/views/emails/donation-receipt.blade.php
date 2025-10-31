<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <title>Resit Derma Rasmi</title>
</head>
<body>
    <h1>Terima Kasih Atas Derma Anda</h1>
    <p>Kami telah menerima derma anda. Berikut adalah butiran transaksi:</p>

    <hr>
    
    {{-- Kita boleh gunakan <table> untuk susun atur yang kemas --}}
    <table>
        <tr>
            <td><strong>Nombor Resit:</strong></td>
            <td>{{ $donation->receipt_number }}</td>
        </tr>
        <tr>
            <td><strong>Nama Penderma:</strong></td>
            <td>{{ $donation->donor_name }}</td>
        </tr>
        <tr>
            <td><strong>Emel Penderma:</strong></td>
            <td>{{ $donation->donor_email }}</td>
        </tr>
        <tr>
            <td><strong>Amaun Diterima:</strong></td>
            <td>RM {{ number_format($donation->amount, 2) }}</td>
        </tr>
        <tr>
            <td><strong>Tarikh/Masa:</strong></td>
            {{-- Bahagian ini yang memerlukan formatting date/time --}}
            <td>{{ $donation->created_at->format('d-m-Y H:i:s') }}</td>
        </tr>
    </table>
    
    <p>Sokongan anda amat bermakna. Jazakallahu Khairan.</p>
</body>
</html>
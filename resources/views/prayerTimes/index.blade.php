<p>Tarikh: {{ $currentDate }}  </p>
<table>

    <tr>
        <td>Subuh:</td>
        <td>{{date('H:i', $prayerData['fajr']) }}</td>
    </tr>
    <tr>
<td>Syuruk:</td>
<td>{{ date('H:i', $prayerData['syuruk']) }}</td>
</tr>
<tr>
<td>Zohor:</td>
<td>{{ date('H:i', $prayerData['dhuhr']) }}</td>
</tr>
<tr>
<td>Asar:</td>
<td>{{ date('H:i', $prayerData['asr']) }}</td>
</tr>
<tr>
<td>Maghrib:</td>
<td>{{ date('H:i', $prayerData['maghrib']) }}</td>
</tr>
<tr>
<td>Isyak:</td>
<td>{{ date('H:i', $prayerData['isha']) }}</td>
</tr>
</table>




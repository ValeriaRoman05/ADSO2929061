<?php 
    $title       = '07- Oper Assignment';
    $description = 'Assign or Update values in variables';

    include 'template/header.php';
    echo "<section>";
?>

<table>
    <thead>
        <tr>
            <th>Operator</th>
            <th>Example</th>
            <th>Is Equal</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>=</td>
            <td>$x=$y</td>
            <td><?='$x=$y'?></td>
        </tr>
        <tr>
            <td>+=</td>
            <td>$x+=$y</td>
            <td><?='$x=$x+$y'?></td>
        </tr>
        <tr>
            <td>-=</td>
            <td>$x-=$y</td>
            <td><?='$x=$x-$y'?></td>
        </tr>
        <tr>
            <td>*=</td>
            <td>$x*=$y</td>
            <td><?='$x=$x*$y'?></td>
        </tr>
        <tr>
            <td>/=</td>
            <td>$x/=$y</td>
            <td><?='$x=$x/$y'?></td>
        </tr>
        <tr>
            <td>.=</td>
            <td>$x.=$y</td>
            <td><?='$x=$x.$y'?></td>
        </tr>
        <tr>
            <td>%=</td>
            <td>$x%=$y</td>
            <td><?='$x=$x%$y'?></td>
        </tr>

    </tbody>
</table>

<?php  include 'template/footer.php'; ?>
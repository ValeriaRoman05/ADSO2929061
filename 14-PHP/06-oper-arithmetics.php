<?php 
    $title       = '06- Oper Arithmetics';
    $description = 'Perform mathematical calculations using numeric values';

    include 'template/header.php';
    echo "<section>";
    $x = 2;
?>

<table>
    <thead>
        <tr>
            <th>Operator</th>
            <th>Description</th>
            <th>Example</th>
            <th>Result</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>+</td>
            <td>Addition</td>
            <td>$x=2 | $x+2</td>
            <td><?=$x+2?></td>
        </tr>
        <tr>
            <td>-</td>
            <td>Substraction</td>
            <td>$x=2 | 5-$x</td>
            <td><?=5-$x?></td>
        </tr>
        <tr>
            <td>*</td>
            <td>Product</td>
            <td>$x=4 | 5*$x</td>
            <td><?php $x=4;  echo 5*$x; ?></td>
        </tr>
        <tr>
            <td>/</td>
            <td>Division</td>
            <td>15/5</td>
            <td><?=15/5?></td>
        </tr>
        <tr>
            <td>%</td>
            <td>Modulus</td>
            <td>5%2</td>
            <td><?=5%2?></td>
        </tr>
        <tr>
            <td>++</td>
            <td>Increment (pos)</td>
            <td>$x=5 | x++</td>
            <td><?php $x=5; echo $x++; ?></td>
        </tr>
        <tr>
            <td>++</td>
            <td>Increment (pre)</td>
            <td>$x=5 | ++x</td>
            <td><?php $x=5; echo ++$x; ?></td>
        </tr>
        <tr>
            <td>--</td>
            <td>Decrement (pre)</td>
            <td>$x=5 | --x</td>
            <td><?php $x=5; echo --$x; ?></td>
        </tr>
    </tbody>
</table>

<?php  include 'template/footer.php'; ?>
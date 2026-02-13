<?php 
    $title       = '08- Oper Comparison';
    $description = 'Compare values and return boolean result';

    include 'template/header.php';
    echo "<section>";
?>

<table>
    <thead>
        <tr>
            <th>Operator</th>
            <th>Description</th>
            <th>Example</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>==</td>
            <td>Is Equal</td>
            <td><?php echo '5==8 | '; var_dump(5==8) ?></td>
        </tr>
        <tr>
            <td>!=</td>
            <td>Is Not Equal</td>
            <td><?php echo '5!=8 | '; var_dump(5!=8) ?></td>
        </tr>
        <tr>
            <td><></td>
            <td>Is Different</td>
            <td><?php echo '5<>8 | '; var_dump(5<>8) ?></td>
        </tr>
        <tr>
            <td>></td>
            <td>Great than</td>
            <td><?php echo '5>8 | '; var_dump(5>8) ?></td>
        </tr>
        <tr>
            <td><</td>
            <td>Less than</td>
            <td><?php echo '5<8 | '; var_dump(5<8) ?></td>
        </tr>
        <tr>
            <td>>=</td>
            <td>Great or Equal than</td>
            <td><?php echo '5>=8 | '; var_dump(5>=8) ?></td>
        </tr>
        <tr>
            <td><=</td>
            <td>Less or Equal than</td>
            <td><?php echo '5<=8 | '; var_dump(5<=8) ?></td>
        </tr>
    </tbody>
</table>

<?php  include 'template/footer.php'; ?>
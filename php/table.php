<tr>
    <td>
        <h2 class="ansPoint">X</h2>
    </td>
    <td>
        <h2 class="ansPoint">Y</h2>
    </td>
    <td>
        <h2 class="ansPoint">R</h2>
    </td>
    <td>
        <h2 class="ansPoint">Result</h2>
    </td>
    <td>
        <h2 class="ansPoint">Time</h2>
    </td>
    <td>
        <h2 class="ansPoint">ScriptTime [us]</h2>
    </td>
</tr>


<?php
foreach ($_SESSION['history'] as $value) { ?>

    <tr>
        <td>
            <h2 class="ansPoint"><?php echo $value[0] ?></h2>
        </td>
        <td>
            <h2 class="ansPoint"><?php echo $value[1] ?></h2>
        </td>
        <td>
            <h2 class="ansPoint"><?php echo $value[2] ?></h2>
        </td>
        <td>
            <h2 class="ansPoint"><?php echo $value[3] ? "True" : "False" ?></h2>
        </td>
        <td>
            <h2 class="ansPoint"><?php echo $value[4] ?></h2>
        </td>
        <td>
            <h2 class="ansPoint"><?php echo number_format($value[5], 10, ".", "")*1000000 ?></h2>
        </td>
    </tr>

<?php }?>
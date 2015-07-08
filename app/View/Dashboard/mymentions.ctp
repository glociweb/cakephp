
<?php if (!empty($mentions)): ?>
    <h2><?php echo __('Notifications'); ?></h2>
    <table class="table table-bordered table-condensed table-striped table-hover">
        <?php
        $i = 1;
        foreach ($mentions as $res):
            ?>
            <tr>
                <th><?php echo $i; ?></th>
                <td>You are mentioned in <a href="">Test Note</a> under <a style="color:#0088cc" href=""><?php echo $res['Project']['title'] ?></a></td>
				<td><i class="label"><?php echo $this->Time->timeAgoInWords($res['Actionitems']['created']); ?></i></td>
            </tr>
            <?php
            $i++;
        endforeach;
        ?>
    </table>
<?php endif; ?>

<?php
/**
 * 
 * ClientEngage: ClientEngage Project Platform (http://www.clientengage.com)
 * Copyright 2012, ClientEngage (http://www.clientengage.com)
 *
 * You must have purchased a valid license from CodeCanyon in order to have 
 * the permission to use this file.
 * 
 * You may only use this file according to the respective licensing terms 
 * you agreed to when purchasing this item on CodeCanyon.
 * 
 * 
 * 
 *
 * @author          ClientEngage <contact@clientengage.com>
 * @copyright       Copyright 2012, ClientEngage (http://www.clientengage.com)
 * @link            http://www.clientengage.com ClientEngage
 * @since           ClientEngage - Project Platform v 1.3.3
 * 
 */
?>

<?php if (!empty($results)): ?>
    <h2><?php echo __('Phases'); ?></h2>
    <table class="table table-bordered table-condensed table-striped table-hover">
        <?php
        $i = 1;
        foreach ($results as $res):
            ?>
            <tr>
                <th><?php echo $i; ?></th>
                <td><?php echo $this->Html->link($res['Phase']['title'], array('controller' => 'projects', 'action' => 'phase', $res['Phase']['slug'], 'admin' => false), array('class' => 'resultlink')); ?></td>
                <td><?php echo $this->Text->highlight($this->Text->truncate($res['Phase']['description'], 200), $query, array('format' => '<span class="highlight">\1</span>')); ?></td>
            </tr>
            <?php
            $i++;
        endforeach;
        ?>
    </table>
<?php endif; ?>

<?php echo $this->element('common/defaultpagination'); ?>

<?php if ($error): ?>
    <div class="alert alert-error keepopen">
        <?php echo __('The search-query has to have at least two characters.'); ?>
    </div>
<?php endif; ?>
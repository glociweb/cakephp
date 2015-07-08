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

<?php if (!empty($results['Project'])): ?>
    <h2><?php echo __('Projects'); ?></h2>
    <table class="table table-bordered table-condensed table-striped table-hover">
        <?php
        $i = 1;
        foreach ($results['Project'] as $res):
            ?>
            <tr>
                <th><?php echo $i; ?></th>
                <td><?php echo $this->Html->link($res['Project']['title'], array('controller' => 'projects', 'action' => 'dashboard', $res['Project']['slug'], 'admin' => false), array('class' => 'resultlink')); ?></td>
                <td><?php echo $this->Text->highlight($this->Text->truncate($res['Project']['description'], 200), $query, array('format' => '<span class="highlight">\1</span>')); ?></td>
            </tr>
            <?php
            $i++;
        endforeach;
        ?>
    </table>
    <?php if (count($results['Project']) == 15) echo $this->Html->link(__('Search all Projects'), array('controller' => 'projects', 'action' => 'search_projects', $query), array('class' => 'btn btn-mini')); ?>
<?php endif; ?>


<?php if (!empty($results['Phase'])): ?>
    <h2><?php echo __('Phases'); ?></h2>
    <table class="table table-bordered table-condensed table-striped table-hover">
        <?php
        $i = 1;
        foreach ($results['Phase'] as $res):
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
<?php if (!empty($results['Notes'])): ?>
		<h2><?php echo __('Notes'); ?></h2>
    <table class="table table-bordered table-condensed table-striped table-hover">
        <?php
        $i = 1;
        foreach ($results['Notes'] as $res):
            ?>
            <tr>
                <th><?php echo $i; ?></th>
                <td><?php echo $this->Html->link($this->Text->truncate(str_replace('&nbsp;', '', strip_tags($res['Notes']['title'])), 60), array('controller' => 'Notes', 'action' => 'view', $res['Notes']['id'],'admin' => false), array('class' => 'resultlink')); ?></td>
                <td><?php echo $this->Text->highlight($this->Text->truncate(strip_tags($res['Notes']['description']), 20000), $query, array('format' => '<span class="highlight">\1</span>')); ?></td>
            </tr>
            <?php
            $i++;
        endforeach;
        ?>
    </table>
    <?php endif; ?>
<?php if (!empty($results['Comment'])): ?>
    <h2><?php echo __('Comments'); ?></h2>
    <table class="table table-bordered table-condensed table-striped table-hover">
        <?php
        $i = 1;
        foreach ($results['Comment'] as $res):
            ?>
            <tr>
                <th><?php echo $i; ?></th>
                <td>
                    <?php
                    echo $this->Html->link($this->Text->highlight($this->Text->truncate(str_replace('&nbsp;', '', strip_tags($res['Comment']['content'])), 200), $query, array('format' => '<span class="highlight">\1</span>')), array('controller' => 'projects', 'action' => 'phase', $res['Phase']['slug'], '#' => $res['Comment']['id'], 'admin' => false), array('class' => 'resultlink', 'escape' => false));
                    ?>
                </td>
            </tr>
            <?php
            $i++;
        endforeach;
        ?>
    </table>
<?php endif; ?>

<?php if (!empty($results['Notescomment'])): ?>
		<h2><?php echo __('Notes Comment'); ?></h2>
    <table class="table table-bordered table-condensed table-striped table-hover">
        <?php
        $i = 1;
        foreach ($results['Notescomment'] as $res):
            ?>
            <tr>
                <th><?php echo $i; ?></th>
                <td>
                    <?php
                    echo $this->Html->link($this->Text->highlight($this->Text->truncate(str_replace('&nbsp;', '', strip_tags($res['Notescomment']['content'])), 200), $query, array('format' => '<span class="highlight">\1</span>')), array('controller' => 'notes', 'action' => 'view', $res['Notescomment']['note_id'], '#' => $res['Notescomment']['id'], 'admin' => false), array('class' => 'resultlink', 'escape' => false));
                    ?>
                </td>
            </tr>
            <?php
            $i++;
        endforeach;
        ?>
    </table>
			
    <?php endif; ?>

<?php if (empty($results['Project']) && empty($results['Phase']) && empty($results['Comment']) && empty($results['Notes']) && empty($results['Notescomment'])): ?>
        <li class="nav-header"><?php echo __('No results...'); ?></li>
    <?php endif; ?>

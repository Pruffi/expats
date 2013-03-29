<? $taxonomies = get_object_taxonomies($pt_key, 'objects'); ?>

<div class="col inline">
    <div class="drag-row inline"></div><div class="inline select">
            <select class="custom-select" name="columns[]">		
                <option value="default" <?=(isset($col) && $col == 'default') ? 'selected="selected"':'' ?>><?=__('Default Columns','kontrolwp')?></option>	
                <option value="">-----------------------</option>																				 
                <option value="<?=(isset($col) && strpos($col, 'kontrol_cf:') !== FALSE) ? $col:'' ?>" <?=(isset($col) && strpos($col, 'kontrol_cf:') !== FALSE) ? 'selected="selected"':'' ?> class="custom-val" customValFormat="kontrol_cf:%s" customLabelFormat="<?=__('Kontrol Custom Field','kontrolwp')?> (%s)" confirmText="<?=__('Enter the Kontrol custom field key for the field you want shown in this column','kontrolwp')?>.">Kontrol <?=__('Custom Field','kontrolwp')?> <?=(isset($col) && strpos($col, 'kontrol_cf:') !== FALSE) ? '('.substr($col, 11, strlen($col)).')':'' ?></option>
               
                <? if(count($taxonomies) > 0) { ?>
                	 <option value="">-----------------------</option>
                     <? foreach($taxonomies as $tax) { ?>
                     		<option value="taxonomy:<?=$tax->name?>" <?=(isset($col) && strpos($col, 'taxonomy:') !== FALSE && $col == 'taxonomy:'.$tax->name) ? 'selected="selected"':'' ?>><?=__('Taxonomy','kontrolwp')?> - <?=$tax->label?></option>
                     <? } ?>
                <? } ?>	
                 <option value="">-----------------------</option>
                <option value="permalink" <?=(isset($col) && $col == 'permalink') ? 'selected="selected"':'' ?>><?=__('Post Permalink','kontrolwp')?> (URL)</option>
                <option value="author" <?=(isset($col) && $col == 'author') ? 'selected="selected"':'' ?>><?=__('Post Author','kontrolwp')?></option>
                <option value="title" <?=(isset($col) && $col == 'title') ? 'selected="selected"':'' ?>><?=__('Post Title','kontrolwp')?></option>
                <option value="date" <?=(isset($col) && $col == 'date') ? 'selected="selected"':'' ?>><?=__('Post Date','kontrolwp')?></option>
                <option value="<?=(isset($col) && strpos($col, 'date:') !== FALSE) ? $col:'' ?>" <?=(isset($col) && strpos($col, 'date:') !== FALSE) ? 'selected="selected"':'' ?> class="custom-val" customValFormat="date:%s" customLabelFormat="<?=__('Post Date Formatted','kontrolwp')?> (%s)"  confirmDefaultVal="d/m/Y" confirmText="<?=__('Enter the PHP date format to display the post date as','kontrolwp')?> eg. d/m/Y = <?=date('d/m/Y')?>"><?=__('Post Date Formatted','kontrolwp')?> <?=(isset($col) && strpos($col, 'date:') !== FALSE) ? '('.substr($col, 5, strlen($col)).')':'' ?></option>
                <option value="<?=(isset($col) && strpos($col, 'modified:') !== FALSE) ? $col:'' ?>" <?=(isset($col) && strpos($col, 'modified:') !== FALSE) ? 'selected="selected"':'' ?> class="custom-val" customValFormat="modified:%s" customLabelFormat="<?=__('Post Modified Formatted','kontrolwp')?> (%s)"  confirmDefaultVal="d/m/Y" confirmText="<?=__('Enter the PHP date format to display the post modified date as','kontrolwp')?> eg. d/m/Y = <?=date('d/m/Y')?> - <?=__('Leave blank for the default','kontrolwp')?>."><?=__('Post Modified Formatted','kontrolwp')?> <?=(isset($col) && strpos($col, 'modified:') !== FALSE) ? '('.substr($col, 9, strlen($col)).')':'' ?></option>
                <option value="excerpt" <?=(isset($col) && $col == 'excerpt') ? 'selected="selected"':'' ?>><?=__('Post Excerpt','kontrolwp')?></option>
                <option value="post_type" <?=(isset($col) && $col == 'post_type') ? 'selected="selected"':'' ?>><?=__('Post Type','kontrolwp')?></option>
                <option value="status" <?=(isset($col) && $col == 'status') ? 'selected="selected"':'' ?>><?=__('Post Status','kontrolwp')?></option>
                <option value="categories" <?=(isset($col) && $col == 'categories') ? 'selected="selected"':'' ?>><?=__('Post Category','kontrolwp')?></option>
                <option value="tags" <?=(isset($col) && $col == 'tags') ? 'selected="selected"':'' ?>><?=__('Post Tag','kontrolwp')?></option>
                <option value="name" <?=(isset($col) && $col == 'name') ? 'selected="selected"':'' ?>><?=__('Post Name','kontrolwp')?></option>
                <option value="parent" <?=(isset($col) && $col == 'parent') ? 'selected="selected"':'' ?>><?=__('Post Parent','kontrolwp')?></option>
                <option value="menu_order" <?=(isset($col) && $col == 'menu_order') ? 'selected="selected"':'' ?>><?=__('Post Menu Order','kontrolwp')?></option>
                <option value="ping_status" <?=(isset($col) && $col == 'ping_status') ? 'selected="selected"':'' ?>><?=__('Ping Status','kontrolwp')?></option>
                <option value="comment_status" <?=(isset($col) && $col == 'comment_status') ? 'selected="selected"':'' ?>><?=__('Comment Status','kontrolwp')?></option>
                <option value="comments" <?=(isset($col) && $col == 'comments') ? 'selected="selected"':'' ?>><?=__('Comment Count','kontrolwp')?></option>
            </select>
    </div>
    <div class="inline duplicate-parent <?=!empty($count) ? 'delete' : ''?>"></div>
</div>
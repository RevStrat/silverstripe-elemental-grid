<?php

namespace TheWebmen\ElementalGrid\Models;

use DNADesign\Elemental\Models\BaseElement;

class CardElement extends BaseElement {
    private static $inline_editable = true;

    private static $singular_name = "Column break";
    
    private static $plural_name = "Column breaks";

    private static $description = "Break column to new row";

    private static $table_name = "ColumnBreakElements";

    public function getType() {
        return 'Column break';
    }

    public function getCMSFields() {
        $fields = parent::getCMSFields();
        
        $fields->removeByName('SizeXS');
        $fields->removeByName('SizeSM');
        $fields->removeByName('SizeMD');
        $fields->removeByName('SizeLG');
        $fields->removeByName('SizeXL');
        $fields->removeByName('OffsetXS');
        $fields->removeByName('OffsetSM');
        $fields->removeByName('OffsetMD');
        $fields->removeByName('OffsetLG');
        $fields->removeByName('OffsetXL');
        $fields->removeByName('VisibilityXS');
        $fields->removeByName('VisibilitySM');
        $fields->removeByName('VisibilityMD');
        $fields->removeByName('VisibilityLG');
        $fields->removeByName('VisibilityXL');
        $fields->removeByName('VerticalAlignment');

        return $fields;
    }
}
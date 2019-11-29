<?php

namespace TheWebmen\ElementalGrid\Extensions;

use SilverStripe\Core\Config\Config;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\HeaderField;

class BaseElementExtension extends \SilverStripe\ORM\DataExtension {

    /**
     * @config
     */
    private static $num_columns = 12;

    /**
     * @var array
     */
    private static $db = array(
        'SizeXS' => 'Int',
        'SizeSM' => 'Int',
        'SizeMD' => 'Int',
        'SizeLG' => 'Int',
        'SizeXL' => 'Int',

        'OffsetXS' => 'Int',
        'OffsetSM' => 'Int',
        'OffsetMD' => 'Int',
        'OffsetLG' => 'Int',
        'OffsetXL' => 'Int',

        'VerticalAlignmentXS' => 'Enum("default,start,end,center,baseline,stretch", "default")',
        'VerticalAlignmentSM' => 'Enum("default,start,end,center,baseline,stretch", "default")',
        'VerticalAlignmentMD' => 'Enum("default,start,end,center,baseline,stretch", "default")',
        'VerticalAlignmentLG' => 'Enum("default,start,end,center,baseline,stretch", "default")',
        'VerticalAlignmentXL' => 'Enum("default,start,end,center,baseline,stretch", "default")',

        'DisplayXS' => 'Enum("default,none,inline,inline-block,block,table,table-cell,table-row,flex,inline-flex", "default")',
        'DisplaySM' => 'Enum("default,none,inline,inline-block,block,table,table-cell,table-row,flex,inline-flex", "default")',
        'DisplayMD' => 'Enum("default,none,inline,inline-block,block,table,table-cell,table-row,flex,inline-flex", "default")',
        'DisplayLG' => 'Enum("default,none,inline,inline-block,block,table,table-cell,table-row,flex,inline-flex", "default")',
        'DisplayXL' => 'Enum("default,none,inline,inline-block,block,table,table-cell,table-row,flex,inline-flex", "default")',

        'OrderXS' => 'Int',
        'OrderSM' => 'Int',
        'OrderMD' => 'Int',
        'OrderLG' => 'Int',
        'OrderXL' => 'Int',

        'BlockType' => 'Varchar'
    );

    public function populateDefaults()
    {
        $defaultSizeField = 'Size' . Config::forClass('TheWebmen\ElementalGrid')->get('defaultSizeField');
        $this->owner->$defaultSizeField = 12;
    }

    /**
     * Get the options for col sizes
     * @return array
     */
    public static function getColSizeOptions($includeDefault = false, $includeNone = false){
        $config = Config::inst()->get(__CLASS__);
        $numColumns = $config['num_columns'];
        $out = array();
        if($includeDefault){
            $out[0] = _t(__CLASS__ . '.DEFAULT', 'Default');
        }else if($includeNone){
            $out[0] = _t(__CLASS__ . '.NONE', 'None');
        }
        for($i = 1; $i < $numColumns + 1; $i++){
            $out[$i] = _t(__CLASS__ . '.COLUMN', 'Column') . ' ' . $i . '/' . $numColumns;
        }
        return $out;
    }

    /**
     * @return array
     */
    public static function getColVisibilityOptions(){
        $out = array();
        $out['default'] = _t(__CLASS__ . '.DEFAULT', 'Default');
        $out['visible'] = _t(__CLASS__ . '.VISIBLE', 'Visible');
        $out['hidden'] = _t(__CLASS__ . '.HIDDEN', 'Hidden');
        return $out;
    }

    /**
     * @param \SilverStripe\Forms\FieldList $fields
     */
    public function updateCMSFields(\SilverStripe\Forms\FieldList $fields)
    {
        $fields->removeByName('BlockType');
        if( $this->getBlockType() == 'full-width' ) {
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
            $fields->removeByName('VerticalAlignment');
        } else {
            $fields->addFieldsToTab('Root.Layout', [
                DropdownField::create('SizeXS', _t(__CLASS__ . '.SIZE_XS', 'Size XS'), self::getColSizeOptions()),
                DropdownField::create('OffsetXS', _t(__CLASS__ . '.OFFSET_XS', 'Offset XS'), self::getColSizeOptions(false, true)),
                DropdownField::create('DisplayXS', 'Display', singleton($this->owner->ClassName)->dbObject('DisplayXS')->enumValues()),
                DropdownField::create('VerticalAlignmentXS', 'Vertical Alignment', singleton($this->owner->ClassName)->dbObject('VerticalAlignmentXS')->enumValues()),
                DropdownField::create('OrderXS', 'Order', self::getColSizeOptions())
            ]);

            $fields->addFieldsToTab('Root.SmallLayout', [
                DropdownField::create('SizeSM', _t(__CLASS__ . '.SIZE_SM', 'Size SM'), self::getColSizeOptions(true)),
                DropdownField::create('OffsetSM', _t(__CLASS__ . '.OFFSET_SM', 'Offset SM'), self::getColSizeOptions(false, true)),
                DropdownField::create('DisplaySM', 'Display', singleton($this->owner->ClassName)->dbObject('DisplaySM')->enumValues()),
                DropdownField::create('VerticalAlignmentSM', 'Vertical Alignment', singleton($this->owner->ClassName)->dbObject('VerticalAlignmentSM')->enumValues()),
                DropdownField::create('OrderSM', 'Order', self::getColSizeOptions())
            ]);

            $fields->addFieldsToTab('Root.MediumLayout', [
                DropdownField::create('SizeMD', _t(__CLASS__ . '.SIZE_MD', 'Size MD'), self::getColSizeOptions(true)),
                DropdownField::create('OffsetMD', _t(__CLASS__ . '.OFFSET_MD', 'Offset MD'), self::getColSizeOptions(false, true)),
                DropdownField::create('DisplayMD', 'Display', singleton($this->owner->ClassName)->dbObject('DisplayMD')->enumValues()),
                DropdownField::create('VerticalAlignmentMD', 'Vertical Alignment', singleton($this->owner->ClassName)->dbObject('VerticalAlignmentMD')->enumValues()),
                DropdownField::create('OrderMD', 'Order', self::getColSizeOptions())
            ]);

            $fields->addFieldsToTab('Root.LargeLayout', [
                DropdownField::create('SizeLG', _t(__CLASS__ . '.SIZE_LG', 'Size LG'), self::getColSizeOptions(true)),
                DropdownField::create('OffsetLG', _t(__CLASS__ . '.OFFSET_LG', 'Offset LG'), self::getColSizeOptions(false, true)),
                DropdownField::create('DisplayLG', 'Display', singleton($this->owner->ClassName)->dbObject('DisplayLG')->enumValues()),
                DropdownField::create('VerticalAlignmentLG', 'Vertical Alignment', singleton($this->owner->ClassName)->dbObject('VerticalAlignmentLG')->enumValues()),
                DropdownField::create('OrderLG', 'Order', self::getColSizeOptions())
            ]);

            $fields->addFieldsToTab('Root.ExtraLargeLayout', [
                DropdownField::create('SizeXL', _t(__CLASS__ . '.SIZE_XL', 'Size XL'), self::getColSizeOptions(true)),
                DropdownField::create('OffsetXL', _t(__CLASS__ . '.OFFSET_XL', 'Offset XL'), self::getColSizeOptions(false, true)),
                DropdownField::create('DisplayXL', 'Display', singleton($this->owner->ClassName)->dbObject('DisplayXL')->enumValues()),
                DropdownField::create('VerticalAlignmentXL', 'Vertical Alignment', singleton($this->owner->ClassName)->dbObject('VerticalAlignmentXL')->enumValues()),
                DropdownField::create('OrderXL', 'Order', self::getColSizeOptions())
            ]);
        }
        //parent::updateCMSFields($fields);
    }

    /**
     * @return string
     */
    public function BootstrapColClasses(){
        //Col options
        $classes = '';
        if($this->owner->SizeXS){
            $classes .= ' col-' . $this->owner->SizeXS;
        }
        if($this->owner->SizeSM){
            $classes .= ' col-sm-' . $this->owner->SizeSM;
        }
        if($this->owner->SizeMD){
            $classes .= ' col-md-' . $this->owner->SizeMD;
        }
        if($this->owner->SizeLG){
            $classes .= ' col-lg-' . $this->owner->SizeLG;
        }
        if($this->owner->SizeXL){
            $classes .= ' col-xl-' . $this->owner->SizeLG;
        }
        //Offset options
        $setOffset = false;
        if($this->owner->OffsetXS){
            $classes .= ' offset-' . $this->owner->OffsetXS;
            $setOffset = true;
        }
        if($this->owner->OffsetSM || $setOffset){
            $classes .= ' offset-sm-' . $this->owner->OffsetSM;
            $setOffset = true;
        }
        if($this->owner->OffsetMD || $setOffset){
            $classes .= ' offset-md-' . $this->owner->OffsetMD;
            $setOffset = true;
        }
        if($this->owner->OffsetLG || $setOffset){
            $classes .= ' offset-lg-' . $this->owner->OffsetLG;
            $setOffset = true;
        }
        if($this->owner->OffsetXL || $setOffset){
            $classes .= ' offset-xl-' . $this->owner->OffsetLG;
            $setOffset = true;
        }
        // Display options
        if($this->owner->DisplayXS && $this->owner->DisplayXS != 'default'){
            $classes .= ' d-' . $this->owner->DisplayXS;
        }
        if($this->owner->DisplaySM && $this->owner->DisplaySM != 'default'){
            $classes .= ' d-sm-' . $this->owner->DisplaySM;
        }
        if($this->owner->DisplayMD && $this->owner->DisplayMD != 'default'){
            $classes .= ' d-md-' . $this->owner->DisplayMD;
        }
        if($this->owner->DisplayLG && $this->owner->DisplayLG != 'default'){
            $classes .= ' d-lg-' . $this->owner->DisplayLG;
        }
        if($this->owner->DisplayXL && $this->owner->DisplayXL != 'default'){
            $classes .= ' d-xl-' . $this->owner->DisplayXL;
        }

        // Order options
        if($this->owner->OrderXS){
            $classes .= ' order-' . $this->owner->OrderXS;
        }
        if($this->owner->OrderSM){
            $classes .= ' order-sm-' . $this->owner->OrderSM;
        }
        if($this->owner->OrderMD){
            $classes .= ' order-md-' . $this->owner->OrderMD;
        }
        if($this->owner->OrderLG){
            $classes .= ' order-lg-' . $this->owner->OrderLG;
        }
        if($this->owner->OrderXL){
            $classes .= ' order-xl-' . $this->owner->OrderXL;
        }

        // Vertical alignment options
        if($this->owner->VerticalAlignmentXS && $this->owner->VerticalAlignmentXS != 'default'){
            $classes .= ' align-self-' . $this->owner->VerticalAlignmentXS;
        }
        if($this->owner->VerticalAlignmentSM && $this->owner->VerticalAlignmentSM != 'default'){
            $classes .= ' align-self-sm-' . $this->owner->VerticalAlignmentSM;
        }
        if($this->owner->VerticalAlignmentMD && $this->owner->VerticalAlignmentMD != 'default'){
            $classes .= ' align-self-md-' . $this->owner->VerticalAlignmentMD;
        }
        if($this->owner->VerticalAlignmentLG && $this->owner->VerticalAlignmentLG != 'default'){
            $classes .= ' align-self-lg-' . $this->owner->VerticalAlignmentLG;
        }
        if($this->owner->VerticalAlignmentXL && $this->owner->VerticalAlignmentXL != 'default'){
            $classes .= ' align-self-xl-' . $this->owner->VerticalAlignmentXL;
        }

        return $classes;
    }

    /**
     * @return string
     */
    public function BulmaColClasses(){
        //Col options
        $classes = '';
        if($this->owner->SizeXS){
            $classes .= ' column is-' . $this->owner->SizeXS . '-mobile';
        }
        if($this->owner->SizeSM){
            $classes .= ' column is-' . $this->owner->SizeSM . '-tablet';
        }
        if($this->owner->SizeMD){
            $classes .= ' column is-' . $this->owner->SizeMD . '-desktop';
        }
        if($this->owner->SizeLG){
            $classes .= ' column is-' . $this->owner->SizeLG . '-widescreen';
        }
        //Offset options
        if($this->owner->OffsetXS){
            $classes .= ' column is-offset-' . $this->owner->OffsetXS . '-mobile';
        }
        if($this->owner->OffsetSM){
            $classes .= ' column is-offset-' . $this->owner->OffsetSM . '-tablet';
        }
        if($this->owner->OffsetMD){
            $classes .= ' column is-offset-' . $this->owner->OffsetMD . '-desktop';
        }
        if($this->owner->OffsetLG){
            $classes .= ' column is-offset-' . $this->owner->OffsetLG . '-widescreen';
        }
        //Visibility options
        if($this->owner->VisibilityXS && $this->owner->VisibilityXS != 'default'){
            $classes .= ' column is-' . $this->owner->VisibilityXS . '-mobile';
        }
        if($this->owner->VisibilitySM && $this->owner->VisibilitySM != 'default'){
            $classes .= ' column is-' . $this->owner->VisibilitySM . '-tablet';
        }
        if($this->owner->VisibilityMD && $this->owner->VisibilityMD != 'default'){
            $classes .= ' column is-' . $this->owner->VisibilityMD . '-desktop';
        }
        if($this->owner->VisibilityLG && $this->owner->VisibilityLG != 'default'){
            $classes .= ' column is-' . $this->owner->VisibilityLG . '-widescreen';
        }
        return $classes;
    }

    public function ColClasses() {
        switch (Config::forClass('TheWebmen\ElementalGrid')->get('cssFramework')){
            case 'bulma':
                return $this->BulmaColClasses();
                break;
            default:
                return $this->BootstrapColClasses();
        }
    }

    public function getBlockType(){
        $type = $this->owner->config()->get('block_type');
        return $type ? $type : 'column';
    }

}

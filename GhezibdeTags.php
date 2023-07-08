<?php

/**
 * module adding subtags to _FNRL and _MILT custom tags.
 */

declare(strict_types=1);

namespace Ghezibde;

use Fisharebest\Webtrees\Elements\DateValue;
use Fisharebest\Webtrees\Elements\EmptyElement;
use Fisharebest\Webtrees\Elements\NoteStructure;
use Fisharebest\Webtrees\Elements\PlaceName;
use Fisharebest\Webtrees\Elements\RestrictionNotice;
use Fisharebest\Webtrees\Elements\XrefMedia;
use Fisharebest\Webtrees\Elements\XrefSource;
use Fisharebest\Webtrees\I18N;
use Fisharebest\Webtrees\Module\AbstractModule;
use Fisharebest\Webtrees\Module\ModuleCustomInterface;
use Fisharebest\Webtrees\Module\ModuleCustomTrait;
use Fisharebest\Webtrees\Registry;

/**
 * Class GhezibdeTags
 */
class GhezibdeTags extends AbstractModule implements ModuleCustomInterface
{
    // For every module interface that is implemented, the corresponding trait *should* also use be used.
    use ModuleCustomTrait;

    /**
     * This module is named 'Ghezibde Custom tags' in the control panel 
     *
     */
    public function title(): string
    {
        return I18N::translate('Ghezibde Custom tags');
    }

    /**
     * A sentence describing what this module does.
     */
    public function description(): string
    {
        return I18N::translate('This module provides Ghezibde custom tags');
    }

    /**
     * The person who created this module.
     */
    public function customModuleAuthorName(): string
    {
        return 'Christophe Dewaele';
    }

    /**
     * The version of this module.
     */
    public function customModuleVersion(): string
    {
        return '2.1.16.1.0';
    }

    /**
     * A URL that will provide the latest version of this module.
     */
    public function customModuleLatestVersionUrl(): string
    {
        return 'https://github.com/cdewaele/ghezibde-tags/raw/main/latest-version.txt';
    }

    /**
     * github repository for this module
     */
    public function customModuleSupportUrl(): string
    {
        return 'https://github.com/cdewaele/ghezibde-tags';
    }

    /**
     * Additional/updated translations.
     *
     * @param string $language
     *
     * @return array<string>
     */
    public function customTranslations(string $language): array
    {
        switch ($language) {
            case 'fr':
            case 'fr-CA':
                return [
                    'This module provides Ghezibde custom tags' => 'Ce module fournit des tags personnalisés pour Ghezibde',
                ];

            default:
                return [];
        }
    }

    /**
     * Called for all *enabled* modules.
     */
    public function boot(): void
    {
        $elementFactory = Registry::elementFactory();
        $elementFactory->registerTags($this->customTags());
        $elementFactory->registerSubTags($this->customSubTags());
    }
    
    /**
     * @return array<string,ElementInterface>
     */
    protected function customTags(): array
    {
        return [
            'INDI:_FNRL'     => new EmptyElement(I18N::translate('Funeral'), 
                    ['DATE' => '0:1', 'PLAC' => '0:1', 'NOTE' => '0:M', 
                        'OBJE' => '0:M', 'SOUR' => '0:M', 'RESN' => '0:1']),
            'INDI:_FNRL:DATE' => new DateValue(I18N::translate('Date')),
            'INDI:_FNRL:PLAC' => new PlaceName(I18N::translate('Place')),
            'INDI:_FNRL:NOTE' => new NoteStructure(I18N::translate('Note')),
            'INDI:_FNRL:OBJE' => new XrefMedia(I18N::translate('Media object')),
            'INDI:_FNRL:SOUR' => new XrefSource(I18N::translate('Source')),
            'INDI:_FNRL:RESN' => new RestrictionNotice(I18N::translate('Restriction')),
            'INDI:_MILT' => new EmptyElement(I18N::translate('Military service'), 
                    ['DATE' => '0:1', 'PLAC' => '0:1', 'NOTE' => '0:M', 
                        'OBJE' => '0:M', 'SOUR' => '0:M', 'RESN' => '0:1']),
            'INDI:_MILT:DATE' => new DateValue(I18N::translate('Date')),
            'INDI:_MILT:PLAC' => new PlaceName(I18N::translate('Place')),
            'INDI:_MILT:NOTE' => new NoteStructure(I18N::translate('Note')),
            'INDI:_MILT:OBJE' => new XrefMedia(I18N::translate('Media object')),
            'INDI:_MILT:SOUR' => new XrefSource(I18N::translate('Source')),
            'INDI:_MILT:RESN' => new RestrictionNotice(I18N::translate('Restriction')),
        ];
    }

    /**
     * @return array<string,array<int,array<int,string>>>
     */
    protected function customSubTags(): array
    {
        return [
            'INDI'      => [['_FNRL', '0:1'], ['_MILT', '0:1']],
            '_FNRL:DATE'      => [['DATE', '0:1']],
            '_FNRL:PLAC'      => [['PLAC', '0:1']],
            '_FNRL:NOTE'      => [['NOTE', '0:M']],
            '_FNRL:OBJE'      => [['OBJE', '0:M']],
            '_FNRL:SOUR'      => [['SOUR', '0:M']],
            '_FNRL:RESN'      => [['RESN', '0:1']],
            '_MILT:DATE'      => [['DATE', '0:1']],
            '_MILT:PLAC'      => [['PLAC', '0:1']],
            '_MILT:NOTE'      => [['NOTE', '0:M']],
            '_MILT:OBJE'      => [['OBJE', '0:M']],
            '_MILT:SOUR'      => [['SOUR', '0:M']],
            '_MILT:RESN'      => [['RESN', '0:1']],
        ];
    }
}

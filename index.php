<?php
/**
 * @version 2.0
 * @author Sammy
 *
 * @keywords Samils, ils, php framework
 * -----------------
 * @package Sammy\Packs\Gogue\Config\Compiler
 * - Autoload, application dependencies
 */
namespace Sammy\Packs\Gogue\Config\Compiler {
  /**
   * Make sure the module base internal class is not
   * declared in the php global scope defore creating
   * it.
   */
  if (!class_exists('Sammy\Packs\Gogue\Config\Compiler\Base')){
  /**
   * @class Base
   * Base internal class for the
   * Gogue\Config\Compiler module.
   * -
   * This is (in the ils environment)
   * an instance of the php module,
   * wich should contain the module
   * core functionalities that should
   * be extended.
   * -
   * For extending the module, just create
   * an 'exts' directory in the module directory
   * and boot it by using the ils directory boot.
   * -
   * \Samils\dir_boot ('./exts');
   */
  class Base {
    /**
     * [__call]
     * @param  array  $configList
     * @return array
     */
    public function __invoke ($configList = []) {
      return $this->compileConfigs ( $configList );
    }
    /**
     * [compileConfigs description]
     * @param  array  $configList
     * @return array
     */
    public function compileConfigs ($configList = []) {
      if (!(is_array ($configList) && $configList)) {
        return [];
      }

      $finalConfigurationsList = array ();

      $keyRe = '/^([^\.]+)\.?/';

      foreach ($configList as $key => $value) {

        $key = trim ($key);

        if (is_numeric($key) || is_int($key)) {
          $finalConfigurationsList [ $key ] = (
            $value
          );
        } elseif (preg_match ( $keyRe, $key, $match)) {
          $keyMatch = preg_replace (
            '/\.$/', '', $match [ 0 ]
          );

          if (empty ($keyName = trim(preg_replace ($keyRe, '', $key)))) {
              $finalConfigurationsList[ $key ] = !is_array($value) ? $value : (
                  $this->compileConfigs ($value)
              );
          } else {
            if (!(isset($finalConfigurationsList[ $keyMatch ]) && is_array($finalConfigurationsList[ $keyMatch ]))) {
                $finalConfigurationsList[ $keyMatch ] = $this->compileConfigs (
                    array ( $keyName => $value )
                );
            } else {
                $finalConfigurationsList[ $keyMatch ] = array_merge (
                    $finalConfigurationsList[ $keyMatch ],
                    $this->compileConfigs (array (
                        $keyName => $value
                    ))
                );
            }
          }
        }
      }

      return $finalConfigurationsList;
    }
  }}

  $module->exports = (
    new Base
  );
}

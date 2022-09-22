<?php
/**
 * @version 2.0
 * @author Sammy
 *
 * @keywords Samils, ils, php framework
 * -----------------
 * @package Sammy\Packs\Gogue\Config
 * - Autoload, application dependencies
 */
namespace Sammy\Packs\Gogue\Config {
  /**
   * Make sure the module base internal class is not
   * declared in the php global scope defore creating
   * it.
   */
  if (!class_exists('Sammy\Packs\Gogue\Config\Compiler')) {
  /**
   * @class Compiler
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
   */
  final class Compiler extends Compiler\Base {
  }}
}

<?php

declare( strict_types=1 );

namespace ChartsCss;

use Html;
use Parser;
use PPFrame;
use Sanitizer;

class ChartsCssHooks {
	/**
	 * Register the <chartscss> tag.
	 */
	public static function onParserFirstCallInit( Parser $parser ): bool {
		$parser->setHook( 'chartscss', [ self::class, 'renderChartsCssTag' ] );
		return true;
	}

	/**
	 * Usage:
	 * <chartscss>
	 *   <table class="charts-css column">...</table>
	 * </chartscss>
	 */
	public static function renderChartsCssTag( string $input, array $args, Parser $parser, PPFrame $frame ): string {
		$parser->getOutput()->addModules( [ 'ext.chartscss' ] );

		$wrapperClasses = [ 'chartscss' ];
		if ( isset( $args['class'] ) && is_string( $args['class'] ) ) {
			foreach ( preg_split( '/\s+/', trim( $args['class'] ) ) as $extraClass ) {
				if ( $extraClass === '' ) {
					continue;
				}
				$wrapperClasses[] = Sanitizer::escapeClass( $extraClass );
			}
		}

		$contentHtml = $parser->recursiveTagParse( $input, $frame );

		return Html::rawElement(
			'div',
			[ 'class' => implode( ' ', $wrapperClasses ) ],
			$contentHtml
		);
	}
}

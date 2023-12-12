/*
** - [show_ab_prices day="weekday"] will return the current season price for a weekday.
** - [show_ab_prices day="weekend"] will return the current season price for a weekend day.
*/

class Show_Jet_AB_Price_Shortcode {
	
	public function __construct() {
		add_shortcode( 'show_ab_prices', array( $this, 'show_ab_prices' ) );
	}

	public function show_ab_prices( $atts ) {
		$defaults = array(
			'day' => 'weekday', // Default to weekday
		);

		$atts = shortcode_atts( $defaults, $atts );
		$day = sanitize_text_field( $atts['day'] ); // Sanitize the "day" argument

		if ( ! function_exists( 'jet_engine' ) ) {
			return '';
		}

		$prices = jet_engine()->listings->data->get_meta( 'jet_abaf_price' );
		$seasonal = $prices['_seasonal_prices'];

		if ( ! empty( $seasonal ) && is_array( $seasonal ) ) {
			$now = strtotime( 'now' );

			foreach ( $seasonal as $index => $season ) {
				if ( $now >= $season['startTimestamp'] && $now <= $season['endTimestamp'] ) {
					$is_season = true;
					$now_season = $index;
					break; // Exit the loop once a matching season is found
				}
			}

			if ($is_season) {
				if ($day === 'weekday') {
					return $seasonal[ $now_season ]['price']; // Return the weekday price during the season
				} elseif ($day === 'weekend' && isset($seasonal[$now_season]['_weekend_prices']['sat']['price'])) {
					return $seasonal[$now_season]['_weekend_prices']['sat']['price']; // Return the weekend price (Saturday) during the season
				}
			}
		}

		return '0'; // Return empty string if no seasonal data, no matching season, or if the specified day is not found
	}
}

new Show_Jet_AB_Price_Shortcode();

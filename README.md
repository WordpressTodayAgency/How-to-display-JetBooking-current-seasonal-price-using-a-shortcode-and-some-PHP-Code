# How-to-display-JetBooking-current-seasonal-price-using-a-shortcode-and-some-PHP-Code
How to display JetBooking current seasonal price using a shortcode and some PHP Code

I needed to display seasonal pricing for JetBooking, but I couldn't find a solution. So, I contacted Crocoblock, and they provided me with a shortcode. However, it wasn't exactly what I was looking for. I needed only the price per night to be returned. Based on their code, I made a few changes and created my own shortcode to return the values I wanted based on the arguments provided.

The shortcode accepts 2 arguments, and it will return the price of the current season for a weekday and weekend:

- [show_ab_prices day="weekday"] will return the current season price for a weekday.
- [show_ab_prices day="weekend"] will return the current season price for a weekend day.

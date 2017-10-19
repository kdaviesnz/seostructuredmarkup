<?php
declare(strict_types=1);

namespace kdaviesnz\seostructuredmarkup;


class SEOStructuredMarkup implements ISEOStructuredMarkup
{

    private $markup;

    /**
     * SEOStructuredMarkup constructor.
     * @param $markup
     */
    public function __construct(string $type, array $fields)
    {
        switch($type) {
            case "product":
                $structuredFields = $this->get_structured_data_product_markup($fields);
                break;
            default:
                $structuredFields = array();
        }
        $this->markup = $this->add_structured_data($structuredFields);
    }

    public function __toString()
    {
        return $this->markup;
    }

    /**
	 * @return array
	 * @see https://developers.google.com/search/docs/data-types/products#guidelines
	 */
	private function get_structured_data_product_markup(array $product) :array
    {

	    $images = $product["images"];

		$structured_data = array(

			'@context' => "http://schema.org/",
			'@type' => 'Product',
			'name' => $product["title"],
			'image' => $images['large']["src"],
			'description' => $product["description"],
			'description' => $product["description"],
			'brand'=>array(
				'@type' => 'Thing',
				'name' => $product["brand"]
			),
			'mpn' => 'MPN',
			'aggregateRating' => array(
				'@type' => 'AggregateRating',
				'ratingValue' => $product["rating"]
			),
			'offers' => array(
				'@type' => 'Offer',
				'priceCurrency' => $product["currency"],
				'price' => $product["price"],
				'seller' => array(
					'@type' => $product["organization"],
					'name' => $product["merchant"]
				)
			)

		);

		return $structured_data;
	}

	/**
	 *
	 * @return string
	 * @see https://developers.google.com/structured-data/?rd=1
	 * @see https://developers.google.com/search/docs/data-types/products#guidelines
	 * @see https://search.google.com/structured-data/testing-tool
	 */
	private function add_structured_data( array $structured_fields ):string
    {
		$json = json_encode( $structured_fields );
			ob_start();
			?>
			<script type="application/ld+json">
				<?php
				echo $json;
				?>
			</script>
			<?php
			return ob_get_clean();
	}



}
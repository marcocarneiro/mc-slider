<h3>
    <?php echo (!empty( $content )) ? esc_html($content) : esc_html( Mc_Slider_Settings::$options['mc_slider_title'] ); ?>
</h3>
<div class="mc-slider flexslider">
    <ul class="slides">
        <li>
            <div class="mcs-container">
                <div class="slider-details-container">
                    <div class="wrapper">
                        <div class="slider-title">
                            <h2>Slider Title</h2>
                        </div>
                        <div class="slider-description">
                            <div class="subtitle">Subtitle</div>
                            <a href="#" class="link">Button Text</a>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</div>
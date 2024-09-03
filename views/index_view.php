<?php

	/* ********************************************************
	 * ********************************************************
	 * ********************************************************/
	class IndexView extends ProjectAbstractView {

        /* ********************************************************
         * ********************************************************
         * ********************************************************/
        public function displayContent() {
			?>
                <h2>Repositiories</h2>
                <p><a href="https://github.com/ARTidas/NewsWatch">https://github.com/ARTidas/NewsWatch</a></p>

                <h2>Issues</h2>
                <ol>
                    <li>Not scraping properly the article contents: Like id: #271</li>
                </ol>

				<h2>TODO</h2>
                <ol>
                    <li>Abstract articles and incorporate source attribute to distinguish.</li>
                    <li>Start scraping news outlets:
                        <ol>
                            <li>http://www.zemplentv.hu/?s=tokaj-hegyalja+egyetem</li>
                            <li>https://eduline.hu/cimke/tokaj-hegyalja%20egyetem</li>
                            <li>https://www.boon.hu/cimke/tokaj-hegyalja-egyetem</li>
                            <li>https://www.origo.hu/kereses?global_filter=tokaj-hegyalja%20egyetem</li>
                            <li>https://sarospatak.hu/?s=tokaj-hegyalja+egyetem&submit=Keres%C3%A9s</li>
                            <li>https://mandiner.hu/cimke/tokaj_hegyalja_egyetem</li>
                        </ol>
                    </li>
					<li>Prepare an algorithm for CoSine Similarity.</li>
                </ol>
			<?php
		}

    }

?>
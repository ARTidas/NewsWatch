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

				<h2>TODO</h2>
                <ol>
                    <li>Visit each article URL and extract the main content from the body: https://pti.unithe.hu:8443/newswatch/article/list</li>
					<li>Prepare an algorithm for CoSine Similarity.</li>
                </ol>
			<?php
		}

    }

?>
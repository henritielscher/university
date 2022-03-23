<form method="GET" action="<?= esc_url(site_url("/")) ?>" class="search-form">
            <label for="s" class="headline headline--medium">Perform a new search:</label>
            <div class="search-form-row">
                <input type="search" name="s" id="s" class="s" placeholder="What are you looking for?" autofocus>
                <input type="submit" value="Search" class="search-submit">
            </div>
</form>
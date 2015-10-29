<form method="post" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
       
        <input class="ainput-text" name="s" id="s" value="<?php __('Enter Search Blog...','weblizar'); ?>"  onFocus="if (this.value == '<?php _e('Enter Search Blog...','weblizar');?>') {this.value = '';}" onBlur="if (this.value == '') {this.value = '<?php _e('Enter Search Blog...','weblizar');?>';}" type="text" />
        <input id="searchsubmit" value="<?php __('Search','weblizar'); ?>" type="submit" />
       
</form>
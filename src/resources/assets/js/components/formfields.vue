<script>
    export default {
        methods: {

            /**
             * Initialize form fields.
             *
             * @param scope
             */
            initializeFormFields(scope)
            {
                this.initializeSelects(scope);
                this.initializeSwitches(scope);
                this.initializeFiles(scope);
            },

            /**
             * @param scope
             */
            initializeSelects(scope)
            {
                scope.find("select").each(function()
                {
                    $(this).select2({
                        placeholder: $(this).attr('data-placeholder')
                    });
                });
            },

            /**
             * @param scope
             */
            initializeSwitches(scope)
            {
                (Array.prototype.slice.call(scope.find('.js-switch'))).forEach(function(elem)
                {
                    new Switchery(elem, {
                        color: '#d9001b',
                        secondaryColor: '#f5f5f5'
                    });
                });
            },

            /**
             * @param scope
             */
            initializeFiles(scope)
            {
                scope.find('input[type="file"]').each( function() {
                    var $input	 = $(this);
                    var $label	 = $input.next('label');
                    var labelVal = $label.html();

                    $input.on('change', function(e) {
                        var fileName = '';

                        if(this.files && this.files.length > 1)
                            fileName = (this.getAttribute('data-multiple-caption') || '').replace(':count', ''+this.files.length);
                        else if(e.target.value)
                            fileName = e.target.value.split('\\').pop();

                        if(fileName)
                            $label.html(fileName);
                        else
                            $label.html(labelVal);
                    });
                });
            },
        }
    }
</script>

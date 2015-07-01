<script id="category" type="x-tmpl-mustache">
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <img src=' <?php echo asset("images/cover/$book->cover") ?>' />
                            <h2></h2>
                            <p><b><?php echo $book->title ?></b></p>
                            <p style="font-size: smaller"><?php echo $book->author ?></p>
                        </div>
                        <div class="product-overlay">
                            <div class="overlay-content">
                                <h2></h2>
                                <h4 style="margin: 15px;font-weight:bold">{{ title }}</h4>

                                <p style="margin:15px;text-align:justify">{{ description }}</p>

                                <P style="color:#000">Stock : {{ $book->stock }}</P>
                                    <a href=" <?php echo route('order', $book->id) ?>"
                                        class="btn btn-default add-to-cart"><i
                                            class="fa fa-book"></i>Order</a>
                                    <a href=' <?php echo url("books/detail/$book->id") ?>'
                                        class="btn btn-default add-to-cart"><i
                                            class="fa fa-eye"></i>Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

</script>
<?php include('header.php') ;?>
<?php
if(isset($_POST['add_category'])){
    $product = $_POST['product'];
    $category = $_POST['category'];
    mysql_query("INSERT INTO product_category (product_id,category_name)VALUES('$product','$category')");
}
?>
<section id="content">
<div class="container">
    <div id="nav_menu">
        <button data-toggle="modal" data-target="#prdct_cat_modal"  class="btn btn-lg btn-default"><span class="glyphicon glyphicon-plus"></span> Products Category</button>

        <button data-toggle="modal" data-target="#food_modal" class="btn btn-lg btn-primary">Add Food</button>
        <button data-toggle="modal" data-target="#bev_modal" class="btn btn-lg btn-primary">Add Beverage</button>
        <button data-toggle="modal" data-target="#addOn_modal" class="btn btn-lg btn-primary">Add Add-On</button>
    </div>
    <table>

    </table>
</div>

    <!-- Modal for Adding Food -->
    <div id="food_modal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Food</h4>
                </div>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" class="form-horizontal" role="form">
                <div class="modal-body">
                    <div class="form-group">
                        <label  class="col-sm-3 control-label">Name of Food:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" placeholder="Enter Name of Food"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-3 control-label">Description:</label>
                        <div class="col-sm-8">
                            <textarea style="width: 100%"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label  class="col-sm-3 control-label">Price:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" placeholder="Enter Price of Food"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label  class="col-sm-3 control-label">Food Status:</label>
                        <div class="radio">
                            <label class="col-sm-2 control-label"><input type="radio" name="status">Available</label>
                            <label class="col-sm-3 control-label"><input type="radio" name="status">Not Available</label>
                        </div>
                    </div>



                </div>

                <div class="modal-footer">
                    <input type="submit" class="btn btn-success" value="Add Food">
                </form>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
    <!-- End Modal for Adding Food -->

    <!-- Modal for Adding Beverages -->
    <div id="bev_modal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Bevarage/Drinks</h4>
                </div>
                <form class="form-horizontal" role="form">
                    <div class="modal-body">
                        <div class="form-group">
                            <label  class="col-sm-4 control-label">Name of Beverage:</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" placeholder="Enter Name of Beverage"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-sm-4 control-label">Description:</label>
                            <div class="col-sm-7">
                                <textarea style="width: 100%"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-sm-4 control-label">Price:</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" placeholder="Enter Price of Beverage"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-sm-4 control-label">Beverage Status:</label>
                            <div class="radio">
                                <label class="col-sm-2 control-label"><input type="radio" name="status">Available</label>
                                <label class="col-sm-3 control-label"><input type="radio" name="status">Not Available</label>
                            </div>
                        </div>



                    </div>
                </form>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-success" value="Add Beverage">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
    <!-- End Modal for Adding Bevarages -->


    <!-- Modal for Adding Add-On -->
    <div id="addOn_modal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content for Add-On-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add-On</h4>
                </div>
                <form class="form-horizontal" role="form">
                    <div class="modal-body">
                        <div class="form-group">
                            <label  class="col-sm-4 control-label">Name of Add-On:</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" placeholder="Enter Name of Add-On"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-sm-4 control-label">Description:</label>
                            <div class="col-sm-7">
                                <textarea style="width: 100%"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-sm-4 control-label">Price:</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" placeholder="Enter Price of Add-On"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-sm-4 control-label">Add-On Status:</label>
                            <div class="radio">
                                <label class="col-sm-2 control-label"><input type="radio" name="status">Available</label>
                                <label class="col-sm-3 control-label"><input type="radio" name="status">Not Available</label>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-success" value="Add Add-On">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal for Add-On -->

    <!-- Modal for Adding Product Categories -->
    <div id="prdct_cat_modal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Product Categories</h4>
                </div>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" class="form-horizontal" role="form">
                    <div class="modal-body">
                        <div class="form-group">
                            <label  class="col-sm-4 control-label">Choose Product:</label>
                            <div class="col-sm-7">
                                <select name="product" class="form-control">
                                    <option selected="selected">-choose product-</option>
                                   <?php
                                   $sql= mysql_query("SELECT * FROM product");
                                   while($row=mysql_fetch_array($sql)):
                                   ?>
                                       <option value="<?php echo $row['product_id']?>"><?php echo $row['product_name'];?></option>
                                <?php endwhile; ?>
                                       </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-sm-4 control-label">Product Category Name:</label>
                            <div class="col-sm-7">
                                <input type="text" name="category" class="form-control" placeholder="Enter Name of Category"/>
                            </div>
                        </div>

                    </div>

                <div class="modal-footer">
                    <input type="submit" name="add_category" class="btn btn-success" value="Add Category">
                </form>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal for Adding Add-On -->



</section>

<?php include('footer.php') ;?>
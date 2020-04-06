<?php $this->load->view('includes/header'); ?>



		<?php $this->load->view('includes/menu'); ?>
		<div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Anin</a></li>
                                <?php 
                                    for ($i=1; $i <= $this->uri->total_segments(); $i++) { 
                                        echo "<li class='breadcrumb-item'><a href='javascript: void(0);'>".$this->uri->segment($i)."</a></li>";
                                    }
                                ?>
                            </ol>
                        </div>
                        <h4 class="page-title"><?php echo substr($page_title, 0, strpos($page_title, '-')); ?></h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 
		<?php $this->load->view($main_content); ?>
		</div>

<?php $this->load->view('includes/footer'); ?>


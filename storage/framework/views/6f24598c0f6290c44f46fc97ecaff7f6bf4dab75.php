<?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.layout-dashboard','data' => ['title' => 'Auto Replies']]); ?>
<?php $component->withName('layout-dashboard'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['title' => 'Auto Replies']); ?>



    <link href="<?php echo e(asset('css/custom.css')); ?>" rel="stylesheet">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Admin</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Users</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->
    <?php if(session()->has('alert')): ?>
        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.alert','data' => []]); ?>
<?php $component->withName('alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
            <?php $__env->slot('type', session('alert')['type']); ?>
            <?php $__env->slot('msg', session('alert')['msg']); ?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <?php endif; ?>
    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>




    <div class="row mt-4">
        <div class="col">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title">Users</h5>


                    <button type="button" class="btn btn-primary" onclick="addUser()">
                        Add User
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive mt-3">
                        <table class="table align-middle">
                            <thead class="table-secondary">
                                <tr>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Total Device</th>
                                    <th>Limit Device</th>
                                    <th>Subscription</th>
                                    <th>Expired subscription</th>
                                    <th>Action</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($user->username); ?></td>
                                        <td><?php echo e($user->email); ?></td>
                                        <td><?php echo e($user->total_device); ?></td>
                                        <td><?php echo e($user->limit_device); ?></td>
                                        <td>
                                            <?php
                                                if ($user->is_expired_subscription) {
                                                    $badge = 'danger';
                                                } else {
                                                    $badge = 'success';
                                                }
                                            ?>
                                            <span
                                                class="badge bg-<?php echo e($badge); ?>"><?php echo e($user->active_subscription); ?></span>
                                        </td>

                                        <td>
                                            <?php
                                                if ($user->is_expired_subscription) {
                                                    echo '<span class="badge bg-danger">-</span>';
                                                } else {
                                                    if ($user->active_subscription == 'active') {
                                                        echo $user->subscription_expired;
                                                    } else {
                                                        echo '<span class="badge bg-danger">-</span>';
                                                    }
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                                <a onclick="editUser(<?php echo e($user->id); ?>)" href="javascript:;"
                                                    class="text-primary" data-bs-toggle="tooltip"
                                                    data-bs-placement="bottom" title="Edit user"><i
                                                        class="bx bxs-edit"></i></a>

                                                <form action="<?php echo e(route('user.delete', $user->id)); ?>" method="POST"
                                                    onsubmit="return confirm('Are you sure will delete this user ? all data user also will deleted')">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <input type="hidden" name="id" value="<?php echo e($user->id); ?>">
                                                    <button type="submit" name="delete"
                                                        class="btn text-sm btn-sm text-danger"><i
                                                            class="bi bi-trash-fill"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <tfoot></tfoot>
                        </table>
                    </div>
                      <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item <?php echo e($users->currentPage() == 1 ? 'disabled' : ''); ?>">
                                <a class="page-link" href="<?php echo e($users->previousPageUrl()); ?>">Previous</a>
                            </li>

                            <?php for($i = 1; $i <= $users->lastPage(); $i++): ?>
                                <li class="page-item <?php echo e($users->currentPage() == $i ? 'active' : ''); ?>">
                                    <a class="page-link" href="<?php echo e($users->url($i)); ?>"><?php echo e($i); ?></a>
                                </li>
                            <?php endfor; ?>

                            <li
                                class="page-item <?php echo e($users->currentPage() == $users->lastPage() ? 'disabled' : ''); ?>">
                                <a class="page-link" href="<?php echo e($users->nextPageUrl()); ?>">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>

        </div>


        <!-- Modal -->
        <div class="modal fade" id="modalUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" enctype="multipart/form-data" id="formUser">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" id="iduser" name="id">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" id="username" class="form-control" value="">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="">
                            <label for="password" class="form-label" id="labelpassword">Password</label>
                            <input type="password" name="password" id="password" class="form-control" value="">
                            <label for="limit_device" class="form-label">Limit Device</label>
                            <input type="number" name="limit_device" id="limit_device" class="form-control"
                                value="">
                            <label for="active_subscription" class="form-label">Active Subscription</label><br>
                            <select name="active_subscription" id="active_subscription" class="form-control">
                                <option value="active" selected>Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="lifetime">Lifetime</option>
                            </select><br>
                            <label for="subscription_expired" class="form-label">Subscription Expired</label>
                            <input type="date" name="subscription_expired" id="subscription_expired"
                                class="form-control" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="modalButton" name="submit" class="btn btn-primary">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>







        <script>
            function addUser() {
                $('#modalLabel').html('Add User');
                $('#modalButton').html('Add');
                $('#formUser').attr('action', '<?php echo e(route('user.store')); ?>');
                $('#modalUser').modal('show');
            }

            function editUser(id) {

                // return;
                $('#modalLabel').html('Edit User');
                $('#modalButton').html('Edit');
                $('#formUser').attr('action', '<?php echo e(route('user.update')); ?>');
                $('#modalUser').modal('show');
                $.ajax({
                    url: "<?php echo e(route('user.edit')); ?>",
                    type: "GET",
                    data: {
                        id: id
                    },
                    dataType: "JSON",
                    success: function(data) {
                        $('#labelpassword').html('Password *(leave blank if not change)');
                        $('#username').val(data.username);
                        $('#email').val(data.email);
                        $('#password').val(data.password);
                        $('#limit_device').val(data.limit_device);
                        $('#active_subscription').val(data.active_subscription);
                        $('#subscription_expired').val(data.subscription_expired);
                        $('#iduser').val(data.id);
                    }
                });
            }
        </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php /**PATH /home/wapisend/my.wapisender.com/resources/views/pages/admin/manageusers.blade.php ENDPATH**/ ?>
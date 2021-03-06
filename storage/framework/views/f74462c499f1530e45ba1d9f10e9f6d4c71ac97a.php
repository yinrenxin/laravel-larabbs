<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            
            <div class="panel-heading">
                <h1>
                    <i class="glyphicon glyphicon-edit"></i> Topic /
                    <?php if($topic->id): ?>
                        编辑话题
                    <?php else: ?>
                        新建话题
                    <?php endif; ?>
                </h1>
            </div>

            <?php echo $__env->make('common.error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <div class="panel-body">
                <?php if($topic->id): ?>
                    <form action="<?php echo e(route('topics.update', $topic->id)); ?>" method="POST" accept-charset="UTF-8">
                        <input type="hidden" name="_method" value="PUT">
                <?php else: ?>
                    <form action="<?php echo e(route('topics.store')); ?>" method="POST" accept-charset="UTF-8">
                <?php endif; ?>

                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">

                    
                <div class="form-group">
                    <input type="text" class="form-control" name="title" value="<?php echo e(old('title',$topic->title)); ?>" placeholder="请填写标题" required>
                </div>

                <div class="form-group">
                    <select class="form-control" name="category_id" required>
                        <option value="" hidden disabled <?php echo e($topic->id ? '' : 'selected'); ?>>请选择分类</option>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="form-group">
                    <textarea class="form-control" name="body" id="editor"  rows="3" placeholder="请输入至少三个字符的内容" required><?php echo e(old('body',$topic->body)); ?></textarea>
                </div>

                    <div class="well well-sm">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a class="btn btn-link pull-right" href="<?php echo e(route('topics.index')); ?>"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/simditor.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/simditor-emoji.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script type="text/javascript"  src="<?php echo e(asset('js/module.js')); ?>"></script>
    <script type="text/javascript"  src="<?php echo e(asset('js/hotkeys.js')); ?>"></script>
    <script type="text/javascript"  src="<?php echo e(asset('js/uploader.js')); ?>"></script>
    <script type="text/javascript"  src="<?php echo e(asset('js/simditor.js')); ?>"></script>
    <script type="text/javascript"  src="<?php echo e(asset('js/simditor-emoji.js')); ?>"></script>



    <script>
        $(document).ready(function(){
            var editor = new Simditor({
                textarea: $('#editor'),
                tabIndent: true,
                toolbar: [
                    'title',
                    'bold',
                    'italic',
                    'underline',
                    'strikethrough',
                    'fontScale',
                    'color',
                    'ol',
                    'ul',
                    'blockquote',
                    'code',
                    'table',
                    'link',
                    'image',
                    'hr',
                    'indent',
                    'outdent',
                    'alignment'],
                upload: {
                    url: '<?php echo e(route('topics.upload_image')); ?>',
                    params: { _token: '<?php echo e(csrf_token()); ?>' },
                    fileKey: 'upload_file',
                    connectionCount: 3,
                    leaveConfirm: '文件上传中，关闭此页面将取消上传。'
                },
                pasteImage: true,
            });
        });
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('content'); ?>
    <div class="max-w-2xl mx-auto">
        <div class="mb-6 flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-900">Edit Task</h2>
            <a href="<?php echo e(route('tasks.index')); ?>" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">
                &larr; Back to Dashboard
            </a>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <form action="<?php echo e(route('tasks.update', $task)); ?>" method="POST" class="space-y-6">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Task Name</label>
                    <input type="text" name="name" value="<?php echo e(old('name', $task->name)); ?>" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-3 focus:ring-indigo-500 focus:border-indigo-500">
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Project</label>
                    <div class="mt-1 relative">
                        <select name="project_id" required
                            class="block w-full rounded-md border-gray-300 shadow-sm border p-3 focus:ring-indigo-500 focus:border-indigo-500">
                            <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($project->id); ?>" <?php echo e(old('project_id', $task->project_id) == $project->id ? 'selected' : ''); ?>>
                                    <?php echo e($project->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>

                <div class="pt-4 flex items-center justify-end gap-3">
                    <a href="<?php echo e(route('tasks.index')); ?>"
                        class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 text-sm font-medium transition-colors">Cancel</a>
                    <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 text-sm font-medium shadow-sm transition-colors">
                        Update Task
                    </button>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /workspaces/task_manager/resources/views/tasks/edit.blade.php ENDPATH**/ ?>
<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            
        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST">
                        <?php echo csrf_field(); ?>
                       

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Nom Complet -->
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Nom Complet *
                                </label>
                                <input type="text" name="name"  required
                                    class="w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500">
                            </div>

                            <!-- Email -->
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Email *
                                </label>
                                <input type="email" name="email"  required
                                    class="w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500">
                            </div>

                            <!-- Téléphone -->
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Téléphone *
                                </label>
                                <input type="text" name="telephone" "
                                    required
                                    class="w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500">
                            </div>

                            <!-- Role (Hidden as managers can only create regular users) -->
                            <input type="hidden" name="role" value="user">

                            <!-- Affiliation -->
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Affiliation *
                                </label>
                                <select name="affiliation" required
                                    class="w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500">
                                    <option value="">Sélectionner...</option>
                                    <option value="professor" >Professeur</option>
                                    <option value="student"  >Étudiant</option>
                                    <option value="extern"  >Externe</option>
                                </select>
                            </div>

                            <!-- Date Inscription (instead of Embauche) -->
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Date d'Inscription *
                                </label>
                                <input type="date" name="registration_date"
                                    
                                    required
                                    class="w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500">
                            </div>

                            <!-- Mot de passe (seulement pour création) -->
                           
                                <div class="md:col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Mot de passe *
                                    </label>
                                    <input type="password" name="password" required
                                        class="w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500">
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Confirmer le mot de passe *
                                    </label>
                                    <input type="password" name="password_confirmation" required
                                        class="w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500">
                                </div>
                           

                            <div class="md:col-span-2 mt-4">
                                <button type="submit"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <i class="fas fa-save mr-2"></i>Enregistrer
                                </button>
                                <a 
                                    class="ml-2 px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                                    Annuler
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\Users\one\Desktop\library-management\resources\views/manager/users/index.blade.php ENDPATH**/ ?>
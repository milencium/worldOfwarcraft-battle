<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\Container1ixEdwc\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/Container1ixEdwc/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/Container1ixEdwc.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\Container1ixEdwc\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \Container1ixEdwc\App_KernelDevDebugContainer([
    'container.build_hash' => '1ixEdwc',
    'container.build_id' => '49eb8afa',
    'container.build_time' => 1651469056,
], __DIR__.\DIRECTORY_SEPARATOR.'Container1ixEdwc');
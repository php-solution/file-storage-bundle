<?php

namespace PhpSolution\FileStorageBundle\Event;

/**
 * FileEvents
 */
final class FileEvents
{
    /** = 'file_storage.on_set_storage_info' */
    const ON_SET_STORAGE_INFO = 'file_storage.on_set_storage_info';
    /** = 'file_storage.on_update_storage_info' */
    const ON_UPDATE_STORAGE_INFO = 'file_storage.on_update_storage_info';
    /** = 'file_storage.pre_upload' */
    const PRE_UPLOAD = 'file_storage.pre_upload';
    /** = 'file_storage.on_upload' */
    const ON_UPLOAD = 'file_storage.on_upload';
    /** = 'file_storage.post_upload' */
    const POST_UPLOAD = 'file_storage.post_upload';
    /** = 'file_storage.on_remove' */
    const ON_REMOVE = 'file_storage.on_remove';
}
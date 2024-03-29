<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

// @codingStandardsIgnoreFile

namespace  AgSoftware\Checkout2\Setup;

use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class InstallSchema implements InstallSchemaInterface
{

    /**
     * {@inheritdoc}
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $table_agsoftware_checkout2 = $setup->getConnection()->newTable($setup->getTable('agsoftware_checkout2'));

        $table_agsoftware_checkout2->addColumn(
            'checkout2_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['identity' => true,'nullable' => false,'primary' => true,'unsigned' => true,],
            'Entity ID'
        );

        $table_agsoftware_checkout2->addColumn(
            'increment_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'increment_id'
        );

        $table_agsoftware_checkout2->addColumn(
            'form_data',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'Form Data'
        );

        $table_agsoftware_checkout2->addColumn(
            'response',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'response'
        );

        $setup->getConnection()->createTable($table_agsoftware_checkout2);
    }
}

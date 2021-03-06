<?php

/**
 * PluginsfOpenAuthRememberKeyTable
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class PluginsfOpenAuthRememberKeyTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object PluginsfOpenAuthRememberKeyTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PluginsfOpenAuthRememberKey');
    }


    /**
     * Удалить просроченные все просроченные ключи и ключи указанного пользователя
     *
     * @param  sfOpenAuthUser $user - Пользователь, чьи ключи надо удалить
     * @param  int            $ttl  - Время жизни ключа, сек
     * @return void
     */
    public function clean(sfOpenAuthUser $user, $ttl)
    {
        $expireDate = date('Y-m-d', TIME - $ttl);
        Doctrine_Query::create()
            ->delete('sfOpenAuthRememberKey k')
            ->andWhere('k.created_at > ?', $expireDate)
            ->orWhere('k.user_id = ?', $user->getId())
            ->execute();
    }

}

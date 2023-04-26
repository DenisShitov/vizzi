<?php
 
namespace app\models;
 
use yii\base\Model;
use yii\base\InvalidParamException;
 
/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{
 
    public $password;
 
    /**
     * @var \app\models\User
     */
    private $_user;
 
    /**
     * Creates a form model given a token.
     *
     * @param string $token
     * @param array $config name-value pairs that will be used to initialize the object properties
     * @throws \yii\base\InvalidParamException if token is empty or not valid
     */
    public function __construct($token, $config = [])
    {
 
        if (empty($token) || !is_string($token)) {
            throw new InvalidParamException('Ключ не должен быть пустым.');
        }
 
        $this->_user = User::findByPasswordResetToken($token);
 
        if (!$this->_user) {
            throw new InvalidParamException('Неверный ключ сброса пароля.');
        }
 
        parent::__construct($config);
    }
 
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['password', 'required', 'message' => 'Заполните поле'],
            ['password', 'string', 'min' => 6, 'message' => 'Минимальное число символов в пароле - 6'],
        ];
    }
 
    /**
     * Resets password.
     *
     * @return bool if password was reset.
     */
    public function resetPassword()
    {
        $user = $this->_user;
        $user->setPassword($this->password);
        $user->removePasswordResetToken();
        return $user->save(false);
    }
 
}
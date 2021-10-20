# How to implement the authentication

Please find below the steps to understand the authentication process :

## User entity

The interface's users are represented by a User entity. It implements the UserInterface & PasswordAuthenticatedUserInterface which provides methods used by the firewall and authentication system for credentials checks.

```
/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 * @UniqueEntity("username")
 *
 * @method string getUserIdentifier()
 */
class User implements PasswordAuthenticatedUserInterface, UserInterface
```

## Setup security.yml

### Provider

```
security:
    # https://symfony.com/doc/current/security.html#where-do-users-come-from-user-providers
    providers:
        database:
            entity:
                class: 'App\Entity\User'
                property: 'username'
```

Indicates to Symfony where can be found the user, in User entity and the defines which attribute is used for authentication.

### Password encryption

```
security:
    password_hashers:
        App\Entity\User:
            algorithm: 'bcrypt'
```

Bcrypt encoder is used to encrypt the passwords before recording in Database

### Firewall

```
security:
    firewalls:
        dev:
            pattern: ^/(_(profiler|wdt)|css|images|js)/
            security: false
        main:
            lazy: true
            provider: database
            custom_authenticator: App\Security\UserAuthenticator
            logout:
                path: app_logout
```

The firewall defines the authentication's process. The credentials are entered in the form_login with the route app_login : login.

### Roles hierarchy

```
security:
    role_hierarchy:
        ROLE_ADMIN: ROLE_USER
```

indicates that the ROLE_ADMIN has the same rights than the ROLE_USER and above.

### Access control

```
security:
    access_control:
        - { path: ^/login, roles: IS_AUTHENTICATED_ANONYMOUSLY }
        - { path: ^/users, roles: ROLE_ADMIN}
        - { path: ^/, roles: ROLE_USER }
```

The access control is set here :
*   the path /login is accessible to anyone
*   the path /users only to logged user with the ROLE_ADMIN
*   the path / to all logged users

## Security Controller
The SecurityController : namespace App\Controller defines how works the authentication process and the error message sent to the View.

## Login Form
The form UserType display the fields to be completed to create a new User :

```
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, ['label' => "Nom d'utilisateur"])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les deux mots de passe doivent correspondre.',
                'required' => $options['passwordRequired'],
                'first_options' => ['label' => 'Mot de passe'],
                'second_options' => ['label' => 'Tapez le mot de passe à nouveau'],
                'mapped'=>false,
            ])
            ->add('email', EmailType::class, ['label' => 'Adresse email'])
        ;

        if ($options['withRoleChoice']) {
            $builder->add('role', ChoiceType::class, [
                'choices' => [
                    'Utilisateur simple' => 'ROLE_USER',
                    'Administrateur' => 'ROLE_ADMIN',
                ],
            ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
        $resolver->setDefault('withRoleChoice', false)->setAllowedTypes('withRoleChoice', ['boolean']);
        $resolver->setDefault('passwordRequired', true)->setAllowedTypes('passwordRequired', ['boolean']);
    }
```
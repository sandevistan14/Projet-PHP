<?php

namespace modules\blog\views;

require '/home/yuta/www/_assets/includes/autoloader.php';

//session_start();
//if(!isset($_SESSION["currentUser"])){
//    header("Location: connectionPage.php");
//    exit();
//}
//if($_SESSION['currentUser']->isActive()){
//    header("Location: homePage.php");
//    exit();
//}

class VerificationPage
{
    private $user;
    private$verification_error;

    /**
     * @param $user
     * @param $verification_error
     */
    public function __construct($user, $verification_error)
    {
        $this->user = $user;
        $this->verification_error = $verification_error;
    }

    public function show(): void {
        ob_start();
        ?>
        <div class="form-container">
        <form action="modules/blog/controllers/verification.php" method="post">
            <h1 class="text-center mb-4">Veuillez entrer le code</h1>
            <p class="text-center">Nous avons envoyé un code de vérification à
            <?php echo $this->user->getMailAddress(); ?></p>
            <div class="d-flex mb-3">
                <input type="tel" maxlength="1" pattern="[0-9]" name='1' id='1' class="form-control inputCode">
                <input type="tel" maxlength="1" pattern="[0-9]" name='2' id='2' class="form-control inputCode">
                <input type="tel" maxlength="1" pattern="[0-9]" name='3' id='3' class="form-control inputCode">
                <input type="tel" maxlength="1" pattern="[0-9]" name='4' id='4' class="form-control inputCode">
                <input type="tel" maxlength="1" pattern="[0-9]" name='5' id='5' class="form-control inputCode">
            </div>
            <div class="d-grid gap-2 col-8 mx-auto custom-mt custom-mb">
                <button type="submit" class="btn btn-primary btn-lg" id="submitButton">Se connecter</button>
            </div>
            <p class="text-center"><a href="modules/blog/controllers/verification.php?resend=1">Renvoyer le code</a></p>
        </form>
        </div>

        <script>
            const form = document.querySelector('form')
            const inputs = form.querySelectorAll('input')
            const KEYBOARDS = {
                backspace: 8,
                arrowLeft: 37,
                arrowRight: 39,
            }

            function handleInput(e) {
                const input = e.target
                const nextInput = input.nextElementSibling
                if (nextInput && input.value) {
                    nextInput.focus()
                    if (nextInput.value) {
                        nextInput.select()
                    }
                }
            }

            function handlePaste(e) {
                e.preventDefault()
                const paste = e.clipboardData.getData('text')
                inputs.forEach((input, i) => {
                    input.value = paste[i] || ''
                })
            }

            function handleBackspace(e) {
                const input = e.target
                if (input.value) {
                    input.value = ''
                    return
                }

                input.previousElementSibling.focus()
            }

            function handleArrowLeft(e) {
                const previousInput = e.target.previousElementSibling
                if (!previousInput) return
                previousInput.focus()
            }

            function handleArrowRight(e) {
                const nextInput = e.target.nextElementSibling
                if (!nextInput) return
                nextInput.focus()
            }

            form.addEventListener('input', handleInput)
            inputs[0].addEventListener('paste', handlePaste)

            inputs.forEach(input => {
                input.addEventListener('focus', e => {
                    setTimeout(() => {
                        e.target.select()
                    }, 0)
                })

                input.addEventListener('keydown', e => {
                    switch(e.keyCode) {
                        case KEYBOARDS.backspace:
                            handleBackspace(e)
                            break
                        case KEYBOARDS.arrowLeft:
                            handleArrowLeft(e)
                            break
                        case KEYBOARDS.arrowRight:
                            handleArrowRight(e)
                            break
                        default:
                    }
                })
            })

        </script>

        <?php
        $content = ob_get_clean();
        (new layout('Yuta', $content))->show();
    }
}

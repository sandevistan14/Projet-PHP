<?php

namespace modules\blog\views;

require '/home/yuta/www/_assets/includes/autoloader.php';

session_start();

class CodeVerification
{
    public function show(): void {
        ob_start();

        ?>

        <!DOCTYPE html>
        <html>
        <head>
            <style>
                h1{
                    font-family: 'Jost', sans-serif;
                    font-size: 170%;
                    font-weight: bold;
                    font-style: normal;
                }
                .form-container {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                }

                .form-control {
                    width: 50px;
                    height: 50px;
                    margin-left: 3%;
                    text-align: center;
                    font-size: 1.25rem;
                }
                .btn-primary {
                    background: linear-gradient(to right,#7623FD,#8E48FF);
                    border-color: #8E48FF; /* Changer la couleur de la bordure */
                }
                .btn-primary:hover{
                    background: linear-gradient(to right,#7623FD,#8E48FF);
                    border-color: #8E48FF; /* Changer la couleur de la bordure */
                }
            </style>
        </head>
        <body>
        <div class="form-container">
        <form action="#">
            <h1 class="text-center mb-4">Veuillez entrer le code</h1>
            <div class="d-flex mb-3">
                <input type="tel" maxlength="1" pattern="[0-9]" class="form-control">
                <input type="tel" maxlength="1" pattern="[0-9]" class="form-control">
                <input type="tel" maxlength="1" pattern="[0-9]" class="form-control">
                <input type="tel" maxlength="1" pattern="[0-9]" class="form-control">
                <input type="tel" maxlength="1" pattern="[0-9]" class="form-control">
            </div>
            <div class="d-grid gap-2 col-8 mx-auto custom-mt custom-mb">
                <button type="submit" class="btn btn-primary btn-lg" id="submitButton">Se connecter</button>
            </div>
        </form>
        </div>
        </body>

        </html>
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
(new CodeVerification())->show();

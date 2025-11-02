<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Title and icon -->
        <title>Error</title>
        <link rel="icon" href="/assets/logo/icon.ico">
        <meta charset="UTF-8" />

        <!-- Settings -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="google" content="notranslate" />
        <meta name="robots" content="follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large"/>

        <!-- Styles -->
        <style>

            :root {
                --color1: #333333; /* Alternative color 1: #FFFFFF */
                --color2: #24A9E1; /* Alternative color 2: #FFCC34 */
            }

            /* Page content */
            body {
                margin: 0 auto;
            }

            /* Title container */
            .container {
                position: fixed;
                display: flex;
                align-items: center;
                justify-content: center;
                width: 100%;
                height: 100%;
                margin: 0 auto;
                text-align: center;
                background: linear-gradient(90deg, var(--color1) 50%, var(--color2) 50%);
            }

            /* Title */
            h1 {
                user-select: none;
                font: bolder 250px "Segoe UI";
                text-transform: uppercase;
                margin: 0;
                background: linear-gradient(90deg, var(--color2) 50%, var(--color1) 50%);
                background-clip: text;
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }

            /* RESPONSIVE DESIGN */
            @media screen and (max-width: 600px) {

                /* Title */
                h1 {
                    font-size: 150px;
                }
            }

        </style>
    </head>
    <body>
        <div class="container">
            <h1><?php echo $error_code ?? 0; ?></h1>
        </div>
    </body>
</html>
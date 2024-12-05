<?php $__env->startSection('content'); ?>
    <style>
        .blog-container {
            padding: 130px 10px 43px 10px;
            background-color: #f9f9f9;
        }



        #featured-blog {
            text-align: center;
            margin-bottom: 40px;
        }

        #featured-blog {
            padding: 0 200px;
            text-align: center;
        }

        #featured-blog h1 {
            font-size: 36px;
            margin: 20px 0;
            color: #333;
        }

        #featured-blog p {
            font-size: 18px;
            color: #444;
            line-height: 1.8;
            text-align: justify;
            margin-bottom: 40px;
        }

        .featured-image {
            width: 100%;
            height: auto;
            max-height: 400px;
            object-fit: cover;
        }






        #posts {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        article {
            background-color: white;
            border: 1px solid #ccc;
            padding: 20px;
            width: 300px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        article img {
            width: 100%;
            height: auto;
            margin-bottom: 15px;
        }

        article h2 {
            font-size: 18px;
            margin: 10px 0;
        }

        article p {
            color: #777;
            font-size: 14px;
            margin-bottom: 10px;
        }

        article a {
            display: inline-block;
            padding: 8px 12px;
            background-color: #ff9800;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>


    <div class="blog-container">
        <section id="featured-blog">
            
        <h1>User Data Deletion Policy</h1>
        <p>We respect your right to privacy and provide the option to delete your account and associated data. If you
            wish to delete your account, you can do so by navigating to the <strong>Profile Settings</strong> section
            and selecting the <strong>Delete Account</strong> button.</p>

        <p>Upon deletion, all your personal data, including profile information, activity logs, and any associated
            content, will be permanently erased from our systems. Please note that this action is irreversible, and we
            will not be able to recover your data once deleted.</p>

        <p>If you have any concerns or require assistance regarding data deletion, please contact our support team at <a
                href="mailto:support@carjock.com">support@yourdomain.com</a>.</p>
    
        </section>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/carjock/resources/views/data-deletion-instructions.blade.php ENDPATH**/ ?>
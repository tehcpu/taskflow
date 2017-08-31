<div class="task_content">
    <div class="section job_show_description" style="text-align: left">
        <div class="head">
            <div class="title">Создание новой задачи</div>
        </div>
        <div class="body">
            <div class="full_information">
                <div class="vacancy_description" style="padding-top: 0">
                    <form class="standart_form js-personal-form">
                        <div class="new_task_group fields_group">
                            <div class="field">
                                <div class="label">
                                    <label for="login">Название</label>
                                </div>
                                <div class="input">
                                    <input class="text" type="text" value="" name="" id="newTaskTitle">
                                </div>
                            </div>
                            <div class="field">
                                <div class="label">
                                    <label for="login">Описание</label>
                                </div>
                                <div class="input">
                                    <textarea class="text" rows="5" name="" id="newTaskBody"></textarea>
                                </div>
                            </div>
                            <div class="field">
                                <div class="label">
                                    <label for="login">Стоимость</label>
                                </div>
                                <div class="input">
                                    <input onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="text" placeholder="100" value="" name="" id="newTaskBudget">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="task_footer">
            <div class="right" style="float: right">
                <input type="submit" name="commit" id="startTask" value="Создать" class="button btn-blue">
            </div>
            <div class="title" style="padding: 7px 0;">
                В системе взимается комиссия в размере 10%
            </div>
        </div>
    </div>
</div>
<script src="/controllers/new_task.js"></script>
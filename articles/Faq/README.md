# Часто задаваемые вопросы

## 1. Git

###### 1.1. Когда пытаюсь сделать `git push` происходит следующее:

```sh
$ git push origin master
password: 
Counting objects: 1156, done.
Delta compression using up to 24 threads.
warning: suboptimal pack - out of memory
fatal: Out of memory, malloc failed (tried to allocate 7934514 bytes)
error: failed to push some refs to '...'
```

**Решение**:

```sh
git config pack.threads 1
```

###### 1.2. Как посмотреть историю изменений файла с помощью команд git?

**Ответ**:

```sh
git log -p имя_файла

# или

git blame имя_файла
```

# 2. Linux

###### 2.1. Как с помощью терминала сделать архив?

```sh
tar -czvf имя_файла_архива.tar.gz путь_к_архивируемой_директории
```

###### 2.2. Как с помощью терминала распакавать архив?

```sh
tar -xzvf имя_файла_архива.tar.gz
```

###### 2.3. Как с помощью терминала скопировать файл на удаленный сервер по SSH?

```sh
scp путь_к_копируемому_файлу user@host.ru:путь_к_директории_на_удаленном_сервере
```

# 3. Bitrix

###### 3.1. Кодировка таблицы "b_имя_таблицы" (latin1) отличается от кодировки базы (utf8)

Решение:

```sql
alter table b_имя_таблицы collate utf8_unicode_ci;
```

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

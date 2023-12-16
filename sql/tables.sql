CREATE TABLE `article` (
                           `idArticle` int(11) NOT NULL,
                           `textArticle` longtext NOT NULL,
                           `titreArticle` varchar(255) NOT NULL,
                           `imageArticle` varchar(255) NOT NULL,
                           `userID` int(11) DEFAULT NULL,
                           PRIMARY KEY (`idArticle`),
                           KEY `userID` (`userID`),
                           CONSTRAINT `article_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `utilisateur` (`idUser`) ON DELETE CASCADE
);

CREATE TABLE `articletag` (
                              `idArticleTag` int(11) NOT NULL,
                              `tagID` int(11) DEFAULT NULL,
                              `ArticleID` int(11) DEFAULT NULL,
                              PRIMARY KEY (`idArticleTag`),
                              KEY `tagID` (`tagID`),
                              KEY `ArticleID` (`ArticleID`),
                              CONSTRAINT `articletag_ibfk_1` FOREIGN KEY (`tagID`) REFERENCES `tag` (`idTag`) ON DELETE CASCADE,
                              CONSTRAINT `articletag_ibfk_2` FOREIGN KEY (`ArticleID`) REFERENCES `article` (`idArticle`) ON DELETE CASCADE
);

CREATE TABLE `categorie` (
                             `idCategorie` int(11) NOT NULL,
                             `nomCateorie` varchar(25) DEFAULT NULL,
                             PRIMARY KEY (`idCategorie`)
);

CREATE TABLE `commande` (
                            `idCommande` int(11) NOT NULL,
                            `numCommande` int(11) NOT NULL,
                            `idPivotfk` int(11) NOT NULL,
                            `dateC` date DEFAULT current_timestamp(),
                            PRIMARY KEY (`idCommande`)
);

CREATE TABLE `commentaire` (
                               `idCommentaire` int(11) NOT NULL,
                               `textCommentaire` varchar(255) NOT NULL,
                               `userID` int(11) DEFAULT NULL,
                               `idArticle` int(11) DEFAULT NULL,
                               PRIMARY KEY (`idCommentaire`),
                               KEY `userID` (`userID`),
                               KEY `idArticle` (`idArticle`),
                               CONSTRAINT `commentaire_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `utilisateur` (`idUser`) ON DELETE CASCADE,
                               CONSTRAINT `commentaire_ibfk_2` FOREIGN KEY (`idArticle`) REFERENCES `article` (`idArticle`) ON DELETE CASCADE
);

CREATE TABLE `panier` (
                          `idPanier` int(11) NOT NULL,
                          `idUser` int(11) NOT NULL,
                          PRIMARY KEY (`idPanier`),
                          KEY `idUser` (`idUser`),
                          CONSTRAINT `panier_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `utilisateur` (`idUser`) ON DELETE CASCADE
);

CREATE TABLE `panierplante` (
                                `idPivot` int(11) NOT NULL,
                                `plante_id` int(11) NOT NULL,
                                `panier_id` int(11) NOT NULL,
                                `quantite` int(11) DEFAULT 1,
                                `status` int(11) NOT NULL DEFAULT 1,
                                PRIMARY KEY (`idPivot`),
                                KEY `plante_id` (`plante_id`),
                                KEY `panier_id` (`panier_id`),
                                CONSTRAINT `panierplante_ibfk_1` FOREIGN KEY (`plante_id`) REFERENCES `plante` (`idPlante`) ON DELETE CASCADE,
                                CONSTRAINT `panierplante_ibfk_2` FOREIGN KEY (`panier_id`) REFERENCES `panier` (`idPanier`) ON DELETE CASCADE
);

CREATE TABLE `plante` (
                          `idPlante` int(11) NOT NULL,
                          `nom` varchar(25) NOT NULL,
                          `prix` double NOT NULL,
                          `image` longblob NOT NULL,
                          `idCategorie` int(11) NOT NULL,
                          PRIMARY KEY (`idPlante`),
                          KEY `idCategorie` (`idCategorie`),
                          CONSTRAINT `plante_ibfk_1` FOREIGN KEY (`idCategorie`) REFERENCES `categorie` (`idCategorie`) ON DELETE CASCADE
);

CREATE TABLE `role` (
                        `idRole` int(11) NOT NULL,
                        `type` varchar(25) DEFAULT NULL CHECK (`type` in ('client','admin','superAdmin')),
                        PRIMARY KEY (`idRole`)
);


CREATE TABLE `tag` (
                       `idTag` int(11) NOT NULL,
                       `textTag` varchar(255) NOT NULL,
                       `themeID` int(11) DEFAULT NULL,
                       PRIMARY KEY (`idTag`),
                       KEY `themeID` (`themeID`),
                       CONSTRAINT `tag_ibfk_1` FOREIGN KEY (`themeID`) REFERENCES `theme` (`idTheme`) ON DELETE CASCADE
);

CREATE TABLE `theme` (
                         `idTheme` int(11) NOT NULL,
                         `nomTheme` varchar(255) NOT NULL,
                         `imageTheme` longblob NOT NULL,
                         `descriptionTheme` varchar(255) NOT NULL,
                         PRIMARY KEY (`idTheme`)
);

CREATE TABLE `utilisateur` (
                               `idUser` int(11) NOT NULL,
                               `nom` varchar(25) NOT NULL,
                               `email` varchar(255) NOT NULL,
                               `passwordUser` varchar(255) DEFAULT NULL,
                               `idRole` int(11) DEFAULT NULL,
                               PRIMARY KEY (`idUser`),
                               KEY `idRole` (`idRole`),
                               CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`idRole`) REFERENCES `role` (`idRole`) ON DELETE CASCADE
);
